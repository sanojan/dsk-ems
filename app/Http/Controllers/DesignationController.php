<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;
use Gate;

class DesignationController extends Controller
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
        $designations = Designation::paginate(5);
        return view('designations.create')->with('designations', $designations);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to add Designation',
                'alert-type' => 'warning'
            );
            return redirect('/dashboard')->with($notification);
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
        
        ['name.required' => 'Designation name is required']);

        $designation = new Designation;
        $designation->name = $request->name;
        $designation->save();
        
        $notification = array(
            'message' => 'Designation has been added sucessfully',
            'alert-type' => 'success'
        );

        return redirect('/designations/create')->with($notification);
        }
        else{
            return redirect('/dashboard')->with($notification);
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
        $designation = Designation::find($id);
        return view('designations.edit')->with('designation', $designation);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to edit Designations',
                'alert-type' => 'warning'
            );
            return redirect('/dashboard')->with($notification);
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
            
            ['name.required' => 'Designation name is required']);
    
            $designation = Designation::find($id);
            $designation->name = $request->name;
            $designation->save();

            $notification = array(
                'message' => 'Designation has been updated sucessfully',
                'alert-type' => 'success'
            );
    
            return redirect('/designations/create')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to edit Designation',
                'alert-type' => 'warning'
            );
            return redirect('/dashboard')->with($notification);
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
        $designation = Designation::find($id);
        $designation->delete();
        
        $notification = array(
            'message' => 'Designation has been deleted sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/designations/create')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to delete designations',
                'alert-type' => 'warning'
            );
            return redirect('/dashboard')->with($notification);
        }
    }
}
