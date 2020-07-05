<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependant extends Model
{
    protected $guarded = ['id']; //← the field name inside the array is not mass-assignable

    protected $hidden = [
        'created_at', 'updated_at', 'staff_id',
    ];

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
