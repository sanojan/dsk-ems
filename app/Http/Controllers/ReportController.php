<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Designation;
use PDF;
use Excel;
use App\Staff;
use App\Exports\StaffExport;

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
        //return view('reports.generate')->with('results', $staff_data);
       
        $dt = \Carbon\Carbon::now();


        $output = '<h1 align="center">Divisional Secretariat - Kalmunai</h1>
                    <h3 align="center"><u>Personal details of ' . $request->designation . '(s)</u></h3>
                    <table width="100%" style="border-collapse: collapse; border: 1px;">
                    <tr>
                    <th style="border: 1px solid; padding:12px; width="20%">Fullname</th>
                    <th style="border: 1px solid; padding:12px; width="20%">DOB</th>
                    <th style="border: 1px solid; padding:12px; width="20%">Permanant Address</th>
                    <th style="border: 1px solid; padding:12px; width="20%">Contact</th>
                    <th style="border: 1px solid; padding:12px; width="20%">NIC No.</th>
                    <th style="border: 1px solid; padding:12px; width="20%">Recruitment Type</th>
                  </tr>
                ';
        foreach($staff_data as $staff){
            $output .= '<tr>
            <td style="border: 1px solid; padding:12px; width="20%">' . $staff->title . ' ' . $staff->firstname . ' ' . $staff->lastname . '</td>
            <td style="border: 1px solid; padding:12px; width="20%">' . $staff->dob . '</td>
            <td style="border: 1px solid; padding:12px; width="20%">' . $staff->permanant_address . '</td>
            <td style="border: 1px solid; padding:12px; width="20%">' . 'Mobile: ' . $staff->mobile_no . '<br />
                     Home: ' . $staff->landline_no . '<br />
                     Email: ' . $staff->email . '
            </td>
            <td style="border: 1px solid; padding:12px; width="20%">' . $staff->nic . '</td>
            <td style="border: 1px solid; padding:12px; width="20%">' . $staff->recruitment_type . '</td>
          </tr> ';
        }
        $output .= '</table>
        <p>I hereby certify that the above statements are true and correct to the best of my knowledge.<p>
        <p>Approved By: DS/AO/CMA <br /> Signature: 
        <footer><p>This report was auto generated on ' . $dt->toDateString() . ' at ' . $dt->toTimeString() . ' using EMS system</footer>';
        //return $output;

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        return $pdf->stream();
        //$result = $request->

        
        

        //return view('reports.generate')->with('results', $staff_data);
        //return $staff_data;

        
        
    }
    
    public function pdf(Request $request)
    {
        
    }

    

    public function export(Request $request) 
    {
        
        return Excel::download(new StaffExport($request->recruitment_type), 'staff_report.xlsx');

        
            
    
    }
}
