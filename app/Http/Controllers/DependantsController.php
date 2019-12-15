<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Dependant;

class DependantsController extends Controller
{
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
    public function create(Request $request)
    {
        $staff = Staff::find($request->staff_id);
        return view('dependants.create')->with('staff', $staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'd_firstname' => 'bail|required|alpha',
            'd_lastname' => 'alpha',
            'd_designation' => 'string|nullable',
            'd_workplace' => 'string|nullable'
        ],
        ['d_firstname.required' => 'Firstname is required']);

        $dep = new Dependant;
        $dep->firstname = $request->d_firstname;
        $dep->lastname = $request->d_lastname;
        $dep->dob = $request->d_dob;
        $dep->relationship = $request->d_relationship;
        $dep->designation = $request->d_designation;
        $dep->workplace = $request->d_workplace;
        $dep->staff_id = $request->staff_id;
        $dep->save();

        return redirect('/staff/' . $request->staff_id)->with('success', 'Dependant added sucessfully');
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
        $dependants = Dependant::find($id);
        return view('dependants.edit')->with('dependants', $dependants);
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
        $this->validate($request, [
            'firstname' => 'bail|required|alpha',
            'lastname' => 'alpha',
            'designation' => 'string|nullable',
            'workplace' => 'string|nullable'
        ],
        ['firstname.required' => 'Firstname is required']);

        $dep = Dependant::find($id);
        $dep->firstname = $request->firstname;
        $dep->lastname = $request->lastname;
        $dep->dob = $request->dob;
        $dep->relationship = $request->relationship;
        $dep->designation = $request->designation;
        $dep->workplace = $request->workplace;
        $dep->save();

        return redirect('/staff/'. $dep->staff_id . '/edit')->with('success', 'Dependant updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
