<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Designation;
use PDF;
use Excel;
use App\Staff;
use App\Exports\StaffExport;
use App\Exports\DependantsExport;
use Gate;

class ReportController extends Controller
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

    
    function index(){
        if (Gate::allows('admin') || Gate::allows('manager')) {
        //$staff_data = $this->get_staff_data();
        $designations = Designation::all();
        $staff = Staff::all();
        $results[] = "";
        return view('reports.index')->with('designations', $designations)->with('staff', $staff);
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to generate reports');
        }

    }

    


    public function export() 
    {
        if (Gate::allows('admin') || Gate::allows('manager')) {
        return Excel::download(new StaffExport, 'staff_data.xlsx');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to generate reports');
        }
    
    }

    public function export_dep(Request $request) 
    {
        if (Gate::allows('admin') || Gate::allows('manager')) {
        $staff = Staff::find($request->staff_id);
        return Excel::download(new DependantsExport($request->staff_id), 'dep_data_of_' . $staff->firstname . '.xlsx');
        }
        else{
            return redirect('/dashboard')->with('error', 'You do not have permission to generate reports');
        }
    
    }
}
