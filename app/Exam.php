<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //Table Name
    protected $table = 'exams';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function staff(){
        return $this->belongsTo('App\Staff');
    }
}
