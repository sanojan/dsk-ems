<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Staff;
use Gate;

class ExamsController extends Controller
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
        return view('exams.create')->with('staff', $staff);
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to add Examinations');
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
        $exam = new Exam;
        $exam->title = $request->title;
        $exam->completed_date = $request->completed_date;
        $exam->remarks = $request->remarks;
        $exam->staff_id = $request->staff_id;

        $exam->save();

        return redirect('/staff/' . $request->staff_id . '/edit')->with('success', 'Exam added sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to add Examinations');
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
        $examinations = Exam::find($id);
        return view('exams.edit')->with('examinations', $examinations);
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to edit Examinations');
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
        $exam = Exam::find($id);
        $exam->title = $request->title;
        $exam->completed_date = $request->completed_date;
        $exam->remarks = $request->remarks;

        $exam->save();

        return redirect('/staff/' . $exam->staff->id . '/edit')->with('success', 'Exam Updated sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to edit Examinations');
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
        if (Gate::allows('admin') || Gate::allows('manager')) {
        $exams = Exam::find($id);
        $exams->delete();

        return redirect('/staff/' . $exams->staff->id . '/edit')->with('success', 'Exam deleted sucessfully');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to delete Examinations');
        }
    }
}
