<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependant extends Model
{
    //Table Name
    protected $table = 'dependants';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function staff(){
        return $this->belongsTo('App\Staff');
    }
}
