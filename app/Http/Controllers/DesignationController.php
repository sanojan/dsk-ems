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
            return redirect('/dashboard')->with('error', 'You do not have permission to create designations');
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

        return redirect('/designations/create')->with('success', 'Designation added sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to create designations');
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
            return redirect('/dashboard')->with('error', 'You do not have permission to edit designations');
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
    
            return redirect('/designations/create')->with('success', 'Designation updated sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to edit designations');
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

        return redirect('/designations/create')->with('success', 'Designation deleted sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to delete designations');
        }
    }
}
