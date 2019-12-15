<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //Table Name
    protected $table = 'designations';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
