<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentImage;
use App\Models\Log;
use App\Mail\TicketNotification;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $comment = new Comment();
        $comment->fill($request->all());
        $comment->save();

        $ticketNo = $comment->ticket->ticket_no;
        $ticketLink = url('/ticket/' . $comment->ticket->id);
        $view = "email.comment_notification";
        $data = [
            'ticketNo' => $ticketNo,
            'ticketLink' => $ticketLink,
        ];
        $subject = "New comment on ticket";

        if( $comment->user->role == 2 ){
            Mail::to($comment->user->email, 'Harsh Raikwar')->send(new TicketNotification($view, $data, $subject));
        } else{ 
            Mail::to('abhishek.choudhary13062000@gmail.com', 'Abhishek Choudhary')->send(new TicketNotification($view, $data, $subject));
        }

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $commentImage = new CommentImage();
                $commentImage->comment_id = $comment->id;
                $imagePath = $image->store('commentImages', 'public');
                $commentImage->image = "storage/{$imagePath}";
                $commentImage->save();
            }
        }

        $log = new Log();
        $log->ticket_id = $request->input('ticket_id');
        $log->user_id = $request->input('user_id');
        $log->action = 'Commented the ticket.';
        $log->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
