<?php

namespace App\Exports;

use App\Dependant;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DependantsExport implements FromQuery, WithHeadings
{

    protected $staff_id;
    /**
    * @return \Illuminate\Support\Collection
    */
    

    public function __construct($staff_id)
    {
        $this->staff_id = $staff_id;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Firstname',
            'Lastname',
            'Date of Birth',
            'Relationship ',
            'Designaton',
            'Workplace',
            'NIC No.'
        ];
    }


    public function query()
    {
        return Dependant::query()->where('staff_id', $this->staff_id);
    }
}
