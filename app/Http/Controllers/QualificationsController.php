<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Qualification;
use Gate;
class QualificationsController extends Controller
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
        
        return view('qualifications.create')->with('staff', $staff);
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
            'title' => 'bail|required|string',
            'field' => 'string|nullable',
            'duration' => 'string|nullable',
            'effective_date' => 'nullable',
            'year' => 'integer',
            'center_no' => 'integer|nullable'
        ],
        ['title.required' => 'Title is required']);

        $qualification = new Qualification;
        $qualification->title = $request->title;
        $qualification->field = $request->field;
        $qualification->medium = $request->medium;
        $qualification->duration = $request->duration;
        $qualification->effective_date = $request->effective_date;
        $qualification->institute = $request->institute;
        $qualification->subject = $request->subject;
        $qualification->grade = $request->grade;
        $qualification->index_no = $request->index_no;
        $qualification->center_no = $request->center_no;
        $qualification->year = $request->year;
        $qualification->attempt = $request->attempt;
        $qualification->staff_id = $request->staff_id;

        $qualification->save();
        $request->flashExcept(['subject', 'grade']);

        $notification = array(
            'message' => 'Qualification has been added sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/qualifications/create?staff_id=' . $request->staff_id)->with($notification);
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
        $qualifications = Qualification::find($id);
        return view('qualifications.edit')->with('qualifications', $qualifications);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to edit Qualifications',
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
        $this->validate($request, [
            'title' => 'bail|required|string',
            'field' => 'string|nullable',
            'duration' => 'string|nullable',
            'effective_date' => 'nullable',
            'center_no' => 'integer|nullable'
        ],
        ['title.required' => 'Title is required']);

        $qualification = Qualification::find($id);
        $qualification->title = $request->title;
        $qualification->field = $request->field;
        $qualification->medium = $request->medium;
        $qualification->grade = $request->grade;
        $qualification->index_no = $request->index_no;
        $qualification->center_no = $request->center_no;
        $qualification->year = $request->year;
        $qualification->attempt = $request->attempt;
        $qualification->duration = $request->duration;
        $qualification->effective_date = $request->effective_date;
        $qualification->institute = $request->institute;
        

        $qualification->save();
        $notification = array(
            'message' => 'Qualification has been updated sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/staff/' . $qualification->staff->id . '/edit')->with($notification);
    }
    else{
        $notification = array(
            'message' => 'You do not have permission to edit Qualifications',
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
        $qualification = Qualification::find($id);
        $qualification->delete();
        
        $notification = array(
            'message' => 'Qualification has been deleted sucessfully',
            'alert-type' => 'success'
        );

        return redirect('/staff/' . $qualification->staff->id . '/edit')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to delete Qualifications',
                'alert-type' => 'warning'
            );
            return redirect('/dashboard')->with($notification);
        }
    }
}
