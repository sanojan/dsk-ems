<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Staff;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $staff = Staff::all();
        return view('dashboard')->with('staff', $staff);
    }

    public function approval()
    {
        return view('approval');
    }

    public function denial()
    {
        return view('denial');
    }

    public function about()
    {
        return view('about');
    }
}
