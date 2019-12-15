<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Qualification;

class QualificationsController extends Controller
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
        return view('qualifications.create')->with('staff', $staff);
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
            'title' => 'bail|required|string',
            'field' => 'string|nullable',
            'duration' => 'string|nullable',
            'effective_date' => 'nullable'
        ],
        ['title.required' => 'Title is required']);

        $qualification = new Qualification;
        $qualification->title = $request->title;
        $qualification->field = $request->field;
        $qualification->medium = $request->medium;
        $qualification->duration = $request->duration;
        $qualification->effective_date = $request->effective_date;
        $qualification->institute = $request->institute;
        $qualification->staff_id = $request->staff_id;

        $qualification->save();

        return redirect('/staff/' . $request->staff_id . '/edit')->with('success', 'Qualification added sucessfully');

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
        $qualifications = Qualification::find($id);
        return view('qualifications.edit')->with('qualifications', $qualifications);
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
            'title' => 'bail|required|string',
            'field' => 'string|nullable',
            'duration' => 'string|nullable',
            'effective_date' => 'nullable'
        ],
        ['title.required' => 'Title is required']);

        $qualification = Qualification::find($id);
        $qualification->title = $request->title;
        $qualification->field = $request->field;
        $qualification->medium = $request->medium;
        $qualification->duration = $request->duration;
        $qualification->effective_date = $request->effective_date;
        $qualification->institute = $request->institute;
        $qualification->staff_id = $request->staff_id;

        $qualification->save();

        return redirect('/staff/' . $request->staff_id . '/edit')->with('success', 'Qualification updated sucessfully');
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
