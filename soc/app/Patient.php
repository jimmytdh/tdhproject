<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'hospital_no',
        'fname',
        'lname',
        'age',
        'sex',
        'status',
        'area',
        'phic',
    ];
}
