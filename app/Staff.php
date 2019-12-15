<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = ['id']; //← the field name inside the array is not mass-assignable

    //Table Name
    protected $table = 'staff';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    //protected $dates = ['dob'];

    public function dependants(){
        return $this->hasMany('App\Dependant');

    }

    public function service_histories(){
        return $this->hasMany('App\ServiceHistory');

    }

    public function qualifications(){
        return $this->hasMany('App\Qualification');

    }

    public function exams(){
        return $this->hasMany('App\Exam');

    }
}
