<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table = 'ip';
    protected $fillable = [
        'ip_type',
        'ip_address',
        'fname',
        'lname',
        'section'
    ];
}
