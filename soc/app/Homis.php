<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homis extends Model
{
    protected $connection = 'homis';
    //hperson - list of patients
    //in
    protected $table = 'hperson';
}
