<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{
    static function create($action,$activity)
    {
        $profile = Session::get('profile');
        $user = $profile->fname." ".$profile->lname;

        Log::create([
            'user' => $user,
            'action' => $action,
            'activity' => $activity
        ]);

    }
}
