<?php

namespace App\Http\Controllers;

use App\Draft;
use App\Item;
use App\Patient;
use PDF;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function printOpdSoa($id)
    {
        //print_r($data);
        $patient = Patient::find($id);
        $charges = Item::where('section','opdcharges')->get();
        $others = Draft::leftJoin('items','items.id','=','drafts.item_id')
                    ->where('patient_id',$id)
                    ->where('section','opdothers')
                    ->first();

        $customPaper = array(0,0,595.276,420.94);
        $pdf = PDF::loadView('page.pdf',[
            'patient' => $patient,
            'charges' => $charges,
            'others' => $others,
            'id' => $id
        ])
            ->setPaper($customPaper, 'portrait');


        return $pdf->stream('OPD-ChargeSlip-'.date('mdy-His').'.pdf');
    }
}
