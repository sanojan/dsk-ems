<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    //Table Name
    protected $table = 'qualifications';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function staff(){
        return $this->belongsTo('App\Staff');
    }
}
