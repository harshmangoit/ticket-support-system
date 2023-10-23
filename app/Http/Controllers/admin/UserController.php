<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'name', 'email', 'role', 'status');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    if ($row->role == 3) {
                        return 'Regular User';
                    } else if ($row->role == 2) {
                        return 'Agent';
                    } else {
                        return 'Admin';
                    }
                })
                ->addColumn('status', function ($row) {
                    if ($row->status) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('user.edit', $row->id) . '" class="btn btn-primary">Edit</a>';
                    //     <form method="POST" action="' . route('user.destroy', $row->id) . '" style="display: inline;">
                    //     ' . csrf_field() . '
                    //     ' . method_field('DELETE') . '
                    //     <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this category?\')" style="width: 70px;">Delete</button>
                    // </form>';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if ($request->get('role') == '3' || $request->get('role') == '2' || $request->get('role') == '1') {
                        $instance->where('role', $request->get('role'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%");
                            $w->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->make(true);
        }

        return view('admin.user.list');

        // $user = User::all();

        // return view('admin.user.list', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|same:password',
            'role' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'name.min' => 'Your name must be at least 3 characters long',
            'name.max' => 'Your name is too long',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email',
            'password.required' => 'Please enter your password',
            'password.min' => 'The password must be at least 8 characters',
            'confirmPassword.required' => 'Enter your confirm password',
            'confirmPassword.same' => 'Password confirmation does not match',
            'role.required' => 'Please assign a specific role',
            'status.required' => 'Please select a status',
        ]);

        $user = new User();
        $user->fill($validatedData);
        $user->save();

        return redirect()->route('user.index')->with('success', 'User registered successfully');
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
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'role' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'name.min' => 'Your name must be at least 3 characters long',
            'name.max' => 'Your name is too long',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email',
            'role.required' => 'Please assign a specific role.',
            'status.required' => 'Please select a status'
        ]);

        $user = User::find($id);
        $user->fill($validatedData);
        $user->save();

        return redirect()->route('user.index')->with('success', 'User details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        // $user->delete();
        return redirect()->back();
        // ->with('success', 'User deleted successfully');
    }
}