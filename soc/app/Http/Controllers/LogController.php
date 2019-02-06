<?php

namespace App\Http\Controllers;

use App\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('login');
    }

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

    public function index()
    {
        $start = Session::get('start_filter');
        $end = Session::get("end_filter");

        $logs = Log::orderBy('created_at','desc');
        if($start)
        {
            $logs = $logs->whereBetween('created_at',[$start,$end]);
        }
        $logs = $logs->paginate(20);

        return view('page.logs',[
            'title' => 'View Logs',
            'logs' => $logs
        ]);
    }

    public function filter(Request $req)
    {
        $range = explode('-',str_replace(' ', '', $req->date));
        $tmp1 = explode('/',$range[0]);
        $tmp2 = explode('/',$range[1]);

        $start = $tmp1[2].'-'.$tmp1[0].'-'.$tmp1[1];
        $end = $tmp2[2].'-'.$tmp2[0].'-'.$tmp2[1];

        $start = Carbon::parse($start)->startOfDay();
        $end = Carbon::parse($end)->endOfDay();

        Session::put('start_filter',$start);
        Session::put('end_filter',$end);

        return redirect('/logs');
    }
}
