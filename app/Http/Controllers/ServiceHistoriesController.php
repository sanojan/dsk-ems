<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Dependant;
use App\Designation;
use App\ServiceHistory;
use App\Service;
use Gate;

class ServiceHistoriesController extends Controller
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
        $designations = Designation::all();
        $services = Service::all();
        return view('servicehistories.create')->with('staff', $staff)->with('designations', $designations)->with('services', $services);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to add service history',
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
            'workplace' => 'bail|required|string',
            'designation' => 'string|required',
            'start_date' => 'required|before:today',
            'end_date' => 'before:today'
        ],
        ['workplace.required' => 'Workplace is required']);

        $serv = new ServiceHistory;
        $designations = Designation::all();
        $services = Service::all();
        $serv->workplace = $request->workplace;
        $serv->designation = $request->designation;
        $serv->start_date = $request->start_date;
        
        if($request->current_wp){
            $staff = Staff::find($request->staff_id);
            foreach($staff->service_histories as $workplaces){
                if($workplaces->current_wp == 1){
                    $notification = array(
                        'message' => 'Current workplace already exists!',
                        'alert-type' => 'info'
                    );
                    return redirect('/servicehistories/create?staff_id=' . $request->staff_id)->with('staff', $staff)->with('designations', $designations)->with('services', $services)->with($notification);
                }
            }
            $serv->end_date = null;
            $serv->current_wp = 1;
        }else{
            $serv->end_date = $request->end_date;
            $serv->current_wp = 0;
        }
        
        $serv->service_name = $request->service;
        $serv->service_class = $request->class;
        
        $serv->staff_id = $request->staff_id;
        $serv->save();

        $notification = array(
            'message' => 'Service has been added sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/staff/' . $request->staff_id . '/edit')->with($notification);
    }
    else{
        $notification = array(
            'message' => 'You do not have permission to add service history',
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
        $servicehistories = ServiceHistory::find($id);
        $designations = Designation::all();
        $services = Service::all();
        return view('servicehistories.edit')->with('servicehistories', $servicehistories)->with('designations', $designations)->with('services', $services);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to edit service history',
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
            'workplace' => 'bail|required|string',
            'designation' => 'string|required',
            'start_date' => 'required'
        ],
        ['workplace.required' => 'Workplace is required']);
        
        $designations = Designation::all();
        $services = Service::all();
        $serv = ServiceHistory::find($id);
        $staff = Staff::find($serv->staff->id);
        $serv->workplace = $request->workplace;
        $serv->designation = $request->designation;
        $serv->start_date = $request->start_date;
        $serv->end_date = $request->end_date;
        $serv->service_name = $request->service;
        $serv->service_class = $request->class;
        if($request->has('current_wp')){
            foreach($staff->service_histories as $workplaces){
                if($workplaces->current_wp == 1){
                    if($workplaces->id == $id){
                    $serv->current_wp = 1;
                }else{
                    $notification = array(
                        'message' => 'Current workplace already exists for ' . $staff->firstname,
                        'alert-type' => 'info'
                    );
                    return redirect('/servicehistories/' . $id . '/edit/')->with('staff', $staff)->with('designations', $designations)->with('services', $services)->with($notification);
                    
                }
            }
            }
            $serv->current_wp = 1;
        }else{
            $serv->current_wp = 0;
        }
        
        $serv->save();
        $notification = array(
            'message' => 'Service has been updated sucessfully',
            'alert-type' => 'success'
        );
        return redirect('/staff/' . $serv->staff->id . '/edit')->with($notification);
    }
    else{
        $notification = array(
            'message' => 'You do not have permission to edit service history',
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
        $service_histories = ServiceHistory::find($id);
        $service_histories->delete();
        
        $notification = array(
            'message' => 'Service history has been deleted sucessfully',
            'alert-type' => 'success'
        );

        return redirect('/staff/' . $service_histories->staff->id . '/edit')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'You do not have permission to delete service history',
                'alert-type' => 'warning'
            );
            return redirect('/dashboard')->with($notification);
        }
    }
}
