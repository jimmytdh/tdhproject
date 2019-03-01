<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    protected $table = 'serial_no';
    protected $fillable = [
        'patient_id',
        'year',
        'number',
        'area'
    ];
}
