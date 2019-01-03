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
        'sex',
        'address',
        'contact',
        'blood_type',
        'dob',
        'hospital_id',
        'tin',
        'gsis',
        'phic',
        'pagibig',
        'designation',
        'e_fname',
        'e_mname',
        'e_lname',
        'e_address',
        'e_contact',
        'picture'
    ];
}
