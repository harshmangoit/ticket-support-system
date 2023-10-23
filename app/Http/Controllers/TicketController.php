<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketImage;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\MailController;
use App\Mail\TicketNotification;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::where('status', 1)->get();;

        $user = auth()->user();

        if ($request->ajax()) {
            if ($user->role == 3) {
                if (!empty($request->get('search'))) {
                    $search = $request->get('search');
                    $tickets = Ticket::with('user')->whereHas('user', function ($query) use ($search) {
                        $query->where('email', 'like', "%$search%");
                    })->where('user_id', $user->id);
                } else {
                    $tickets = Ticket::where('user_id', $user->id);
                }
            } else if ($user->role == 2) {
                if (!empty($request->get('search'))) {
                    $search = $request->get('search');
                    $tickets = Ticket::with('user')->whereHas('user', function ($query) use ($search) {
                        $query->where('email', 'like', "%$search%");
                    })->where('agent_id', $user->id);
                } else {
                    $tickets = Ticket::where('agent_id', $user->id);
                }
            } else {
                if (!empty($request->get('search'))) {
                    $search = $request->get('search');
                    $tickets = Ticket::with('user')->whereHas('user', function ($query) use ($search) {
                        $query->where('email', 'like', "%$search%");
                    })->Select('*');
                } else {
                    $tickets = Ticket::Select('*');
                }
            }
            return DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d-m-Y');
                })
                ->addColumn('status', function ($row) {
                    if ($row->status) {
                        return 'Closed';
                    } else {
                        return 'Open';
                    }
                })
                ->addColumn('agent_id', function ($row) {
                    if ($row->agent_id) {
                        return 'Assigned';
                    } else {
                        return 'Non-assigned';
                    }
                })
                ->addColumn('priority', function ($row) {
                    if ($row->priority) {
                        return 'High';
                    } else {
                        return 'Low';
                    }
                })
                ->addColumn('action', function ($row) {
                    $user = auth()->user();
                    if ($user->role == 1) {
                        return '<a href="' . route('ticket.edit', $row->id) . '" class="btn btn-primary">Edit</a>
                        <a href="' . route('ticket.show', $row->id) . '" class="btn btn-primary">Detail</a>
                        <a href="' . route('ticket.log', $row->id) . '" class="btn btn-primary">Logs</a>';
                    } else {
                        return '<a href="' . route('ticket.show', $row->id) . '" class="btn btn-primary">Detail</a>
                        <a href="' . route('ticket.log', $row->id) . '" class="btn btn-primary">Logs</a>';
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if ($request->get('priority') == '0' || $request->get('priority') == '1') {
                        $instance->where('priority', $request->get('priority'));
                    }
                    if ($request->get('category')) {
                        $instance->where('category_id', $request->get('category'));
                    }
                    if ($request->get('assigned') == '0') {
                        $instance->where('agent_id', NULL);
                    } else if ($request->get('assigned') == '1') {
                        $instance->where('agent_id', '<>', NULL);
                    }
                })
                ->make(true);
        }
        return view('ticket.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();;
        return view('ticket.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'category' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData['priority'] = $request->input('priority');
        $validatedData['category_id'] = $request->input('category');
        $validatedData['user_id'] = $request->input('user_id');

        $ticket = new Ticket();
        $ticket->fill($validatedData);
        $ticket->save();

        $ticket->ticket_no = $ticket->id + 1000000;
        $ticket->save();

        $ticketNo = $ticket->ticket_no;
        $ticketLink = url('/ticket/' . $ticket->id . '/edit');
        $view = "email.admin_notification";
        $data = [
            'ticketNo' => $ticketNo,
            'ticketLink' => $ticketLink,
        ];
        $subject = "New Ticket Created";
        Mail::to('harshraikwar42@gmail.com', 'Harsh Raikwar')->send(new TicketNotification($view, $data, $subject));                                                                 // MailController::mail($request);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $ticketimage = new TicketImage();
                $ticketimage->ticket_id = $ticket->id;
                $imagePath = $image->store('ticketImages', 'public');
                $ticketimage->image = "storage/{$imagePath}";
                $ticketimage->save();
            }
        }

        $log = new Log();
        $log->ticket_id = $ticket->id;
        $log->user_id = $validatedData['user_id'];
        $log->action = "Created the ticket";
        $log->save();

        return redirect()->route('ticket.index')->with('success', 'Ticket created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::find($id);
        return view('ticket.detail', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::where('status', 1)->get();
        $agents = User::where('status', 1)->where('role', 2)->get();
        $ticket = Ticket::find($id);

        return view('admin.ticket.edit', compact('ticket', 'categories', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'agent' => 'required',
        ]);

        $validatedData['priority'] = $request->input('priority');
        $validatedData['category_id'] = $request->input('category');
        $validatedData['agent_id'] = $request->input('agent');

        $ticket = Ticket::find($id);

        //Check agent is assigned to ticket or not.
        $agent = $ticket->agent_id;

        $ticket->fill($validatedData);
        $ticket->save();

        if ($agent != $request->input('agent')) {
            $ticketNo = $ticket->ticket_no;
            $ticketLink = url('/ticket/' . $ticket->id);
            $view = "email.agent_notification";
            $data = [
                'ticketNo' => $ticketNo,
                'ticketLink' => $ticketLink,
            ];
            $subject = "New Ticket Assigned";
            Mail::to('harshraikwar42@gmail.com', 'Harsh Raikwar')->send(new TicketNotification($view, $data, $subject));
        }

        $log = new Log();
        $log->ticket_id = $ticket->id;
        $log->user_id = $request->input('user_id');
        $log->action = "Updated the ticket";
        $log->save();

        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function log(string $id)
    {
        $ticket = Ticket::find($id);
        return view('ticket.log', compact('ticket'));
    }

    public function close(Request $request, string $id)
    {
        $ticket = Ticket::where('id', $id)->update(['status' => 1]);
        dd($ticket);

        $ticketNo = $ticket->ticket_no;
        $ticketLink = url('/ticket/' . $ticket->id);
        $view = "email.user_notification";
        $data = [
            'ticketNo' => $ticketNo,
            'ticketLink' => $ticketLink,
        ];
        $subject = "Ticket Closed";
        Mail::to('harshraikwar42@gmail.com', 'Harsh Raikwar')->send(new TicketNotification($view, $data, $subject));  

        $log = new Log();
        $log->ticket_id = $id;
        $log->user_id = $request->query('user_id');
        $log->action = 'Closed the ticket.';
        $log->save();
        return redirect()->route('ticket.index')->with('success', 'Ticket closed successfully');
    }
}
