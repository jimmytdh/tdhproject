<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    protected $table = 'greetings';
    protected $connection = 'admin';
}
