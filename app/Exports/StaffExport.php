<?php

namespace App\Exports;

use App\Staff;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StaffExport implements FromQuery, WithHeadings, 
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $designation;

    
    function __construct($designation) 
    {
        $this->designation = $designation;
    }


    
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Firstname',
            'Lastname',
            'Gender',
            'Civil Status',
            'Religion',
            'Nationality',
            'Date of Birth',
            'Permanant Address',
            'Temporary Address',
            'Mobile No.',
            'Landline No.',
            'Email',
            'NIC',
            'Service',
            'Designation',
            'Service Class',
            'Staff Category',
            'Appointment No.',
            'Appointment Date',
            'Personal File No.',
            'Officer Subject',
            'Officer Branch',
            'Bank Account No',
            'Bank Branch',
            'Bank Name'
        ];
    }

    

    public function query()
    {
        
        return Staff::where('designation', $this->designation);
    }

}
