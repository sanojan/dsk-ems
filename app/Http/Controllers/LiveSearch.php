<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;
use Staff;

class LiveSearch extends Controller
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
    
    function index()
    {
     return view('live_search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('staff')
         ->where('firstname', 'like', '%'.$query.'%')
         ->orWhere('lastname', 'like', '%'.$query.'%')
         ->orWhere('nic', 'like', '%'.$query.'%')
         ->orWhere('officer_subject', 'like', '%'.$query.'%')
         ->orderBy('id', 'ASC')
         ->get();
         
      }
      else
      {
       $data = DB::table('staff')
         ->orderBy('id', 'ASC')
         ->get();
      }

      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {

        $output .= '
        <tr>
         <td>'.$row->id .'</td>
         <td><img src="storage/profile_pics/' . $row->profile_pic . '" alt="User Avatar" 
         class="img-size-50 img-circle mr-3" ></td>
         <td>'. $row->title . $row->firstname . '</td>
         <td>'.$row->designation.'</td>
         <td>
         <a href="staff/' . $row->id . '" target="" class="btn btn-primary btn-xs">View</a>
         <a href="staff/' . $row->id . '/edit" target="" class="btn btn-success btn-xs">Edit</a>
         <form action="staff/' . $row->id . '" method="POST" onclick= "return confirm(\'Are you sure?\')">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button class="btn btn-danger btn-xs">Delete User</button>
        </form>
         </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
