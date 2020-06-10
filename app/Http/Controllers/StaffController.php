<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Staff;
use App\Dependant;
use App\ServiceHistory;
use App\Designation;
use App\Service;
use Carbon\Carbon;
use File;
use Storage;

class StaffController extends Controller
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
        $staff = Staff::paginate(1);
        return view('staff.index')->with('staff', $staff);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = new Staff;
        $designations = Designation::all();
        $services = Service::all();
        return view('staff.create')->with('staff', $staff)->with('designations', $designations)->with('services', $services);
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
            'lastname' => 'regex:/^[\pL\s\-]+$/u|nullable',
            'mobile_no' => 'digits:10|nullable',
            'landline_no' => 'digits:10|nullable',
            'email' => 'email:rfc|nullable',
            'nic' => 'required|alpha_num|unique:staff|max:12',
            'profile_pic' => 'image|nullable|max:1999'
        ],
        ['nic.required' => 'NIC is required']);

        //Handle File Upload
        if($request->hasFile('profile_pic')){
            // Get file name with extension
            //$filenameWithExt = $request->profile_pic->path();
            // Get filename only
            //$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get extension only
            $extension = $request->profile_pic->extension();
            //Filename to store
            $fileNameToStore = time() . '.' . $extension;
            //UploadImage
            $path = $request->profile_pic->storeAs('public/profile_pics', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.png';
        }

        $staff = new Staff;
        $staff->title = $request->title;
        $staff->firstname = $request->firstname;
        $staff->lastname = $request->lastname;
        $staff->gender = $request->gender;
        $staff->civil_status = $request->civil_status;
        $staff->religion = $request->religion;
        $staff->nationality = $request->nationality;
        $staff->dob = $request->dob;
        $staff->permanant_address = $request->permanant_address;
        $staff->temporary_address = $request->temporary_address;
        $staff->mobile_no = $request->mobile_no;
        $staff->landline_no = $request->landline_no;
        $staff->email = $request->email;
        $staff->nic = $request->nic;
        $staff->service = $request->service;
        $staff->designation = $request->designation;
        $staff->class = $request->class;
        $staff->appointment_no = $request->appointment_no;
        $staff->appointment_date = $request->appointment_date;
        $staff->personal_file_no = $request->personal_file_no;
        $staff->officer_subject = $request->officer_subject;
        $staff->officer_branch = $request->officer_branch;
        $staff->profile_pic = $fileNameToStore;

        $staff->save();
        
        

        return redirect('/staff')->with('success', 'Staff profile created sucessfully');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::find($id);
        $dt = Carbon::create($staff->dob)->addYears(60)->toDateString();
        
        //$xp= '';
        
        if(isset($staff->appointment_date)){
            $xp = Carbon::now()->diff($staff->appointment_date)->format('%y Year(s), %m Month(s) and %d Day(s)');
        }else{
            $xp = 'Not Available';
        }
        

        
        $dependants = $staff->dependants;
        $service_histories = collect($staff->service_histories)->sortByDesc('start_date');
        return view('staff.show')->with('staff', $staff)->with('dependants', $dependants)->with('service_histories', $service_histories)->with('retirement_date', $dt)->with('exp', $xp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        $designations = Designation::all();
        $services = Service::all();
        return view('staff.edit')->with('staff', $staff)->with('designations', $designations)->with('services', $services);
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
            'lastname' => 'regex:/^[\pL\s\-]+$/u|nullable',
            'mobile_no' => 'digits:10|nullable',
            'landline_no' => 'digits:10|nullable',
            'email' => 'email:rfc|nullable',
            'nic' => 'required|alpha_num|max:12',
            'profile_pic' => 'image|nullable|max:1999'
        ],
        ['nic.required' => 'NIC is required']);
        
        $staff = Staff::find($id);

        //Handle File Upload
        if($request->hasFile('profile_pic')){
            // Get file name with extension
            //$filenameWithExt = $request->profile_pic->path();
            // Get filename only
            //$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get extension only
            $extension = $request->profile_pic->extension();
            //Filename to store
            $fileNameToStore = time() . '.' . $extension;
            //UploadImage
            $path = $request->profile_pic->storeAs('public/profile_pics', $fileNameToStore);
            
            if($staff->profile_pic != 'noimage.png'){
                $oldpic = 'public/profile_pics/' . $staff->profile_pic;
                Storage::delete($oldpic);
            }

        }else{
            
            $fileNameToStore = $staff->profile_pic;
        }

        $staff->title = $request->title;
        $staff->firstname = $request->firstname;
        $staff->lastname = $request->lastname;
        $staff->gender = $request->gender;
        $staff->civil_status = $request->civil_status;
        $staff->religion = $request->religion;
        $staff->nationality = $request->nationality;
        $staff->dob = $request->dob;
        $staff->permanant_address = $request->permanant_address;
        $staff->temporary_address = $request->temporary_address;
        $staff->mobile_no = $request->mobile_no;
        $staff->landline_no = $request->landline_no;
        $staff->email = $request->email;
        $staff->nic = $request->nic;
        $staff->service = $request->service;
        $staff->designation = $request->designation;
        $staff->class = $request->class;
        $staff->appointment_no = $request->appointment_no;
        $staff->appointment_date = $request->appointment_date;
        $staff->personal_file_no = $request->personal_file_no;
        $staff->officer_subject = $request->officer_subject;
        $staff->officer_branch = $request->officer_branch;
        $staff->profile_pic = $fileNameToStore;
        
        Rule::unique('nic')->ignore($staff);

        $staff->save();
        return redirect('/staff/' . $id . '/edit')->with('success', 'Staff profile updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();

        return redirect('/staff')->with('success', 'Staff profile deleted sucessfully');
    }
}
