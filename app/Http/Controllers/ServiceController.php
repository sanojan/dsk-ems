<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Gate;

class ServiceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin')) {
        $services = Service::paginate(5);
        return view('services.create')->with('services', $services);
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to create services');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('admin')) {
        $this->validate($request, [
            'name' => 'bail|required|alpha_spaces',],
            
            ['name.required' => 'Service name is required']);
    
            $service = new Service;
            $service->name = $request->name;
            $service->save();
    
            return redirect('/services/create')->with('success', 'Service added sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to create services');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('admin')) {
        $service = Service::find($id);
        return view('services.edit')->with('service', $service);
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to edit services');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('admin')) {
        $this->validate($request, [
            'name' => 'bail|required|alpha_spaces',],
            
            ['name.required' => 'Service name is required']);
    
            $service = Service::find($id);
            $service->name = $request->name;
            $service->save();
    
            return redirect('/services/create')->with('success', 'Service updated sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to edit services');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('admin')) {
        $service = Service::find($id);
        $service->delete();

        return redirect('/services/create')->with('success', 'Service deleted sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to delete services');
        }
    }
}
