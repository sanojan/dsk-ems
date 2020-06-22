<?php

namespace App\Exports;

use App\Staff;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StaffExport implements FromQuery, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $recruitment_type;

    function __construct($recruitment_type) 
    {
        $this->recruitment_type = $recruitment_type;
    }

    public function collection()
    {
        
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
        
        return Staff::where('recruitment_type', $this->recruitment_type);
    }

}
