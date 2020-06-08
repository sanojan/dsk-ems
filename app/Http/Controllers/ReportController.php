<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Designation;
use PDF;

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

        //$staff_data = $this->get_staff_data();
        $designations = Designation::all();
        $results[] = "";
        return view('reports.index')->with('designations', $designations);

    }

    function get_staff_data(Request $request){

        $staff_data = DB::table('staff')->where('designation', $request->designation)->get();

        return view('reports.generate')->with('results', $staff_data);
        //return $staff_data;
    }

    function pdf($results){
        $pdf = \App::make('dompdf.wrapper');
        //$result = $request->
        $staff_data = DB::table('staff')->where('designation', $result->designation)->get();
        $output = '<h3 align="center">Staff Data</h3>
                    <table width="100%" style="border-collapse: collapse; border: 0px;">
                    <tr>
                    <th style="border: 1px solid; padding:12px; width="20%">Fullname</th>
                    <th style="border: 1px solid; padding:12px; width="20%">DOB</th>
                    <th style="border: 1px solid; padding:12px; width="20%">Permanant Address</th>
                    <th style="border: 1px solid; padding:12px; width="20%">Contact</th>
                    <th>Service Name</th>
                    <th style="border: 1px solid; padding:12px; width="20%">Recruitment Type</th>
                  </tr>
                ';
        foreach($staff_data as $staff){
            $output .= '<tr>
            <td>' . $staff->title . ' ' . $staff->firstname . ' ' . $staff->lastname . '</td>
            <td>' . $staff->dob . '</td>
            <td>' . $staff->permanant_address . '</td>
            <td>' . 'Mobile: ' . $staff->mobile_no . '<br />
                     Home: ' . $staff->landline_no . '<br />
                     Email: ' . $staff->email . '
            </td>
            <td>' . $staff->service . '</td>
            <td>' . $staff->recruitment_type . '</td>
          </tr> ';
        }
        $output .= '</table>';
        $pdf->loadHTML($output);
        $pdf->stream();
    }

    
    
}
