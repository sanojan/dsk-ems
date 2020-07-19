<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Staff;
use App\Dependant;
use DB;
use Gate;

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
        if (Gate::allows('admin') || Gate::allows('manager')) {
        $staff = Staff::find($request->staff_id);
        return view('dependants.create')->with('staff', $staff);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to add Qualifications',
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
        if (Gate::allows('admin') || Gate::allows('manager')) {
        $this->validate($request, [
            'firstname' => 'bail|required|regex:/^[a-z ,.\'-]+$/i',
            'lastname' => 'regex:/^[\pL\s\-]+$/u',
            'designation' => 'string|nullable',
            'workplace' => 'string|nullable',
            'nic' => 'alpha_num|unique:dependants|max:12|nullable'
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
            $notification = array(
                'message' => 'Employee NIC and dependant NIC cannot be same',
                'alert-type' => 'warning'
            );

            return redirect('/dependants/create?staff_id=' . $request->staff_id)->with($notification);
        }

        
        $dep->nic = $request->nic;
        $dep->save();
        $notification = array(
            'message' => 'Depndant has been added sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/staff/' . $request->staff_id . '/edit')->with($notification);
    }
    else{
        $notification = array(
            'message' => 'You do not have permission to add Dependants',
            'alert-type' => 'warning'
        );
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
        if (Gate::allows('admin') || Gate::allows('manager')) {
        $dependants = Dependant::find($id);
        return view('dependants.edit')->with('dependants', $dependants);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to edit Dependants',
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
        if (Gate::allows('admin') || Gate::allows('manager')) {
        $dep = Dependant::find($id);
        $this->validate($request, [
            'firstname' => 'bail|required|regex:/^[a-z ,.\'-]+$/i',
            'lastname' => 'regex:/^[\pL\s\-]+$/u',
            'designation' => 'string|nullable',
            'workplace' => 'string|nullable',
            'nic' => 'max:12|alpha_num|nullable|unique:dependants,nic,' . $dep->id
        ],
        ['firstname.required' => 'Firstname is required']);

        
        $dep->firstname = $request->firstname;
        $dep->lastname = $request->lastname;
        $dep->dob = $request->dob;
        $dep->relationship = $request->relationship;
        $dep->designation = $request->designation;
        $dep->workplace = $request->workplace;
        //$staff_nic = DB::table('staff')->where('id', $dep->staff_id)->get();
        if($request->nic == $dep->staff->nic){
            $notification = array(
                'message' => 'Employee NIC and dependant NIC cannot be same',
                'alert-type' => 'warning'
            );
            return redirect('/dependants/'. $dep->staff_id . '/edit')->with($notification);
        }
        
        $dep->nic = $request->nic;
        
        $dep->save();
        $notification = array(
            'message' => 'Dependant has been updated sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/staff/'. $dep->staff_id . '/edit')->with($notification);
    }
    else{
        $notification = array(
            'message' => 'You do not have permission to edit Dependant',
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
        $dependant = Dependant::find($id);
        $dependant->delete();
        $notification = array(
            'message' => 'Qualification has been deleted sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/staff/' . $dependant->staff->id . '/edit')->with($notification);
        }
        else{

            $notification = array(
                'message' => 'You do not have permission to delete Dependants',
                'alert-type' => 'warning'
            );
            return redirect('/dashboard')->with($notification);
        }
    }
}
