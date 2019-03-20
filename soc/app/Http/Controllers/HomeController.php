<?php

namespace App\Http\Controllers;

use App\Item;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index()
    {
        return view('page.home',[
            'title' => 'Dashboard: Summary of Charges'
        ]);
    }

    public function data()
    {
        $data = array();
        $last = Carbon::now()->addDay(-6);
        $day = date('M d, Y',strtotime($last));

        for($i=0;$i<7;$i++)
        {
            $tmp_day = date('M d',strtotime($day));
            $data['chart1'][] = array(
                'day' => $tmp_day,
                'opd' => self::countPatientChart1('OPD',$day),
                'er' => self::countPatientChart1('ER',$day),
                'dr' => self::countPatientChart1('DR',$day),
                'or' => self::countPatientChart1('OR',$day),
            );
            $day = date('M d, Y',strtotime('1 day',strtotime($day)));
        }

        $hours = array(
            array(
                'start' => '00:00:00',
                'end' => '04:00:00'
            ),array(
                'start' => '04:00:00',
                'end' => '08:00:00'
            ),array(
                'start' => '08:00:00',
                'end' => '12:00:00'
            ),array(
                'start' => '12:00:00',
                'end' => '16:00:00'
            ),array(
                'start' => '16:00:00',
                'end' => '20:00:00'
            ),array(
                'start' => '20:00:00',
                'end' => '23:59:59'
            )
        );

        foreach($hours as $hr)
        {
            $tmp = (object)$hr;
            $start = date('ha',strtotime($tmp->start));
            $end = date('ha',strtotime($tmp->end));

            $data['chart2'][] = array(
                'hour' =>  "$start-$end",
                'opd' => self::countPatientChart2('OPD',$tmp->start,$tmp->end),
                'er' => self::countPatientChart2('ER',$tmp->start,$tmp->end),
                'dr' => self::countPatientChart2('DR',$tmp->start,$tmp->end),
                'or' => self::countPatientChart2('OR',$tmp->start,$tmp->end),
            );
        }

        $data['chart3'][] = array(
                    'label' => 'OPD',
                    'value' => self::countPatientChart3('OPD')
                );
        $data['chart3'][] = array(
                    'label' => 'ER',
                    'value' => self::countPatientChart3('ER')
                );
        $data['chart3'][] = array(
                    'label' => 'OR',
                    'value' => self::countPatientChart3('OR')
                );
        $data['chart3'][] = array(
                    'label' => 'DR',
                    'value' => self::countPatientChart3('DR')
                );


        $month = Carbon::now()->startOfYear();
        for($i=0; $i<12; $i++)
        {
            $start = Carbon::parse($month)->startOfDay()->addMonth($i);
            $end = Carbon::parse($month)->endOfMonth()->addMonth($i);
            $period = date('M',strtotime($start));
            $data['chart4'][] = array(
                'period' => $period,
                'opd' => self::countPatientChart4('OPD',$start,$end),
                'er' => self::countPatientChart4('ER',$start,$end),
                'dr' => self::countPatientChart4('DR',$start,$end),
                'or' => self::countPatientChart4('OR',$start,$end),
            );
        }

        return $data;
    }

    public function countPatientChart1($area,$date)
    {
        $start = Carbon::parse($date)->startOfDay();
        $end = Carbon::parse($date)->endOfDay();
        $count = Patient::where('area',$area)
                    ->whereBetween('created_at',[$start,$end])
                    ->count();
        return $count;
    }

    public function countPatientChart2($area,$start,$end)
    {
        $day = Carbon::now()->startOfMonth();
        $start = date('Y-m-d',strtotime($day))." ".date('H:i:s',strtotime($start));
        $end = date('Y-m-d',strtotime($day))." ".date('H:i:s',strtotime($end));

        $num_days = Carbon::now()->daysInMonth;

        Carbon::parse($day)->parse($start)->addDay(1);
        $count = 0;
        for($num_days; $num_days >= 0; $num_days--)
        {
            $start_time = Carbon::parse($start)->addDay($num_days);
            $end_time = Carbon::parse($end)->addDay($num_days);

            $count += Patient::where('area',$area)
                        ->whereBetween('created_at',[$start_time,$end_time])
                        ->count();
        }
        return $count;
    }

    public function countPatientChart3($area)
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $total = Patient::whereBetween('created_at',[$start,$end])->count();
        $count = Patient::whereBetween('created_at',[$start,$end])->where('area',$area)->count();
        $ave = ($count/$total)*100;

        return number_format($ave,0);
    }

    public function countPatientChart4($area,$start,$end)
    {
        $count = Patient::where('area',$area)
                    ->whereBetween('created_at',[$start,$end])
                    ->count();
        return $count;
    }

    public function summary()
    {
        $date = Item::orderBy('updated_at','desc')
                    ->first()
                    ->updated_at;

        return view('page.summary',[
            'last_update' => date('F d, Y h:i A',strtotime($date)),
            'fixed' => Item::where('section','fixed')->get(),
            'room' => Item::where('section','room')->get(),
            'procedure' => Item::where('section','procedure')->get(),
            'supplies' => Item::where('section','supplies')->get(),
            'equipment' => Item::where('section','equipment')->get(),
            'gas' => Item::where('section','gas')->get(),
            'outsource' => Item::where('section','outsource')->get(),
            'ancillary' => Item::where('section','ancillary')->get(),
            'orcharge' => Item::where('section','orcharge')->get(),
            'orprocedure' => Item::where('section','orprocedure')->get(),
            'orsupply' => Item::where('section','orsupply')->get(),
            'orsuture' => Item::where('section','orsuture')->get(),
            'orfluid' => Item::where('section','orfluid')->get(),
            'ormedicine' => Item::where('section','ormedicine')->get(),
            'title' => 'Summary of Charges'
        ]);
    }
}
