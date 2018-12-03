<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'ext',
        'address',
        'blood_type',
        'dob',
        'tin',
        'gsis',
        'phic',
        'pagibig',
        'designation',
        'e_fname',
        'e_mname',
        'e_lname',
        'e_address',
        'contact',
        'picture'
    ];
}
