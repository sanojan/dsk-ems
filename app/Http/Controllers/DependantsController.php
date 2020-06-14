<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Dependant;
use DB;

class DependantsController extends Controller
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
            'firstname' => 'bail|required|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'regex:/^[\pL\s\-]+$/u',
            'designation' => 'string|nullable',
            'workplace' => 'string|nullable',
            'nic' => 'alpha_num|unique:dependants|max:12'
        ],
        ['d_firstname.required' => 'Firstname is required']);

        $dep = new Dependant;
        $staff = Staff::find($request->staff_id);
        $dep->firstname = $request->firstname;
        $dep->lastname = $request->lastname;
        $dep->dob = $request->dob;
        $dep->relationship = $request->relationship;
        $dep->designation = $request->designation;
        $dep->workplace = $request->workplace;
        $dep->staff_id = $request->staff_id;
        
        if($request->nic == $staff->nic){
            return redirect('/dependants/create?staff_id=' . $request->staff_id)->with('error', 'Employee NIC and dependant NIC cannot be same');
        }
        $dep->nic = $request->nic;
        $dep->save();

        return redirect('/staff/' . $request->staff_id . '/edit')->with('success', 'Dependant added sucessfully');
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
            'firstname' => 'bail|required|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'regex:/^[\pL\s\-]+$/u',
            'designation' => 'string|nullable',
            'workplace' => 'string|nullable',
            'nic' => 'alpha_num|unique:dependants|max:12'
        ],
        ['firstname.required' => 'Firstname is required']);

        $dep = Dependant::find($id);
        $dep->firstname = $request->firstname;
        $dep->lastname = $request->lastname;
        $dep->dob = $request->dob;
        $dep->relationship = $request->relationship;
        $dep->designation = $request->designation;
        $dep->workplace = $request->workplace;
        //$staff_nic = DB::table('staff')->where('id', $dep->staff_id)->get();
        if($request->nic == $dep->staff->nic){
            return redirect('/dependants/'. $dep->staff_id . '/edit')->with('error', 'Employee NIC and dependant NIC cannot be same');
        }
        $dep->nic = $request->nic;
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
        $dependant = Dependant::find($id);
        $dependant->delete();

        return redirect('/staff/' . $dependant->staff->id . '/edit')->with('success', 'Dependant deleted sucessfully');
    }
}
