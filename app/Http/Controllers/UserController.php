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
        $users = User::all();

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

    public function enable($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['updated_at' => now()]);
        $notification = array(
            'message' => 'User account has been enabled successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.users.index')->with($notification);
    }   

    public function revoke($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['updated_at' => null]);
        $notification = array(
            'message' => 'User account has been disabled successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.users.index')->with($notification);
    }

    public function usertype($user_id, Request $request)
    {
        $user = User::findOrFail($user_id);
        if($request->user_role == 'admin'){
            $user->update(['role' => $request->user_role]);
            $user->update(['admin' => 1]);
        }
        else{
            $user->update(['admin' => 0]);
            $user->update(['role' => $request->user_role]);
        }
        
        $notification = array(
            'message' => 'User account type has been changed successfully',
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
