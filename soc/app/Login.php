<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'level',
        'username',
        'password',
        'area'
    ];
}
