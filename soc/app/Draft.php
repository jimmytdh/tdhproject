<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    protected $fillable = [
        'patient_id',
        'item_id',
        'qty',
    ];
}
