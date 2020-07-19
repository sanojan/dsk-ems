<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::whereNull('approved_at')->get();

        return view('users', compact('users'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['approved_at' => now()]);
        $notification = array(
            'message' => 'User has been approved successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.users.index')->with($notification);
    }

    public function profile()
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        return view('profile')->with('user', $user);
    }
}
