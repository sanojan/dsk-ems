<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    //Table Name
    protected $table = 'service_histories';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function staff(){
        return $this->belongsTo('App\Staff');
    }
}
