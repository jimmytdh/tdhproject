<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index()
    {
        $date = Item::orderBy('updated_at','desc')
                    ->first()
                    ->updated_at;

        return view('page.home',[
            'last_update' => date('F d, Y h:i A',strtotime($date)),
            'fixed' => Item::where('section','fixed')->get(),
            'room' => Item::where('section','room')->get(),
            'procedure' => Item::where('section','procedure')->get(),
            'supplies' => Item::where('section','supplies')->get(),
            'equipment' => Item::where('section','equipment')->get(),
            'gas' => Item::where('section','gas')->get(),
            'outsource' => Item::where('section','outsource')->get(),
            'ancillary' => Item::where('section','ancillary')->get(),
            'title' => 'Homepage: Summary of Charges'
        ]);
    }
}
