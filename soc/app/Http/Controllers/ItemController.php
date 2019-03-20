<?php

namespace App\Http\Controllers;

use App\Draft;
use App\Item;
use App\Patient;
use App\Serial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController as Log;

class ItemController extends Controller
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

        return view('page.items',[
            'last_update' => date('F d, Y h:i A',strtotime($date)),
            'fixed' => Item::where('section','fixed')->get(),
            'room' => Item::where('section','room')->get(),
            'procedure' => Item::where('section','procedure')->get(),
            'supplies' => Item::where('section','supplies')->get(),
            'equipment' => Item::where('section','equipment')->get(),
            'gas' => Item::where('section','gas')->get(),
            'outsource' => Item::where('section','outsource')->get(),
            'ancillary' => Item::where('section','ancillary')->get(),
            'title' => 'Create/Update Charges: ER/DR'
        ]);
    }

    public function index2()
    {
        $date = Item::orderBy('updated_at','desc')
            ->first()
            ->updated_at;

        return view('page.items2',[
            'last_update' => date('F d, Y h:i A',strtotime($date)),
            'orcharge' => Item::where('section','orcharge')->get(),
            'orprocedure' => Item::where('section','orprocedure')->get(),
            'orsupply' => Item::where('section','orsupply')->get(),
            'orsuture' => Item::where('section','orsuture')->get(),
            'orfluid' => Item::where('section','orfluid')->get(),
            'ormedicine' => Item::where('section','ormedicine')->get(),
            'title' => 'Create/Update Charges: OR'
        ]);
    }

    public function index3()
    {
        $date = Item::orderBy('updated_at','desc')
            ->first()
            ->updated_at;

        return view('page.items3',[
            'last_update' => date('F d, Y h:i A',strtotime($date)),
            'charges' => Item::where('section','opdcharges')->get(),
            'others' => Item::where('section','opdothers')->get(),
            'title' => 'Create/Update Charges: OPD'
        ]);
    }

    public function save(Request $req)
    {
        $data = array(
            'section' => $req->section,
            'name' => $req->name,
            'amount' => $req->amount,
            'type' => $req->type
        );

        Item::create($data);
        Session::put('section',$req->section);

        Log::create('Add Item',"$req->name is added");
        return redirect()->back()->with('status','added');
    }

    public function edit($id)
    {
        $data = Item::find($id);

        return $data;
    }

    public function update(Request $req)
    {
        $data = array(
            'section' => $req->section,
            'name' => $req->name,
            'amount' => $req->amount,
            'type' => $req->type
        );
        $id = $req->id;

        Log::create('Update Item',"$req->name is updated");
        Item::where('id',$id)
            ->update($data);
        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        $name = Item::find($id)->name;
        Log::create('Delete Item',"$name is deleted");
        Item::where('id',$id)->delete();
        return redirect()->back()->with('status','deleted');
    }

    public function generate($id)
    {
        $patient = Patient::find($id);
        $area = $patient->area;
        $page = '';
        if($area=='ER' || $area=='DR'){
            return view('page.generate',[
                'id' => $id,
                'fixed' => Item::where('section','fixed')->get(),
                'room' => Item::where('section','room')->get(),
                'procedure' => Item::where('section','procedure')->get(),
                'supplies' => Item::where('section','supplies')->get(),
                'equipment' => Item::where('section','equipment')->get(),
                'gas' => Item::where('section','gas')->get(),
                'outsource' => Item::where('section','outsource')->get(),
                'ancillary' => Item::where('section','ancillary')->get(),
                'patient' => $patient
            ]);
        }
        elseif($area=='OR'){
            return view('page.generate2',[
                'id' => $id,
                'orcharge' => Item::where('section','orcharge')->get(),
                'orprocedure' => Item::where('section','orprocedure')->get(),
                'orsupply' => Item::where('section','orsupply')->get(),
                'orfluid' => Item::where('section','orfluid')->get(),
                'orsuture' => Item::where('section','orsuture')->get(),
                'ormedicine' => Item::where('section','ormedicine')->get(),
                'patient' => $patient
            ]);
        }
        elseif($area=='OPD'){
            return view('page.generate3',[
                'id' => $id,
                'opdcharges' => Item::where('section','opdcharges')->get(),
                'opdothers' => Item::where('section','opdothers')->get(),
                'patient' => $patient
            ]);
        }

        return redirect()->back()->with('status','no_area');
    }

    public function updateCharges($id)
    {
        $patient = Patient::find($id);
        $area = $patient->area;

        if($area=='ER' || $area=='DR')
        {
            return view('page.update',[
                'title' => 'Update Charges',
                'id' => $id,
                'fixed' => Item::where('section','fixed')->get(),
                'room' => Item::where('section','room')->get(),
                'procedure' => Item::where('section','procedure')->get(),
                'supplies' => Item::where('section','supplies')->get(),
                'equipment' => Item::where('section','equipment')->get(),
                'gas' => Item::where('section','gas')->get(),
                'outsource' => Item::where('section','outsource')->get(),
                'ancillary' => Item::where('section','ancillary')->get(),
                'patient' => $patient

            ]);
        }else if($area=='OR'){
            return view('page.update2',[
                'title' => 'Update Charges',
                'id' => $id,
                'orcharge' => Item::where('section','orcharge')->get(),
                'orprocedure' => Item::where('section','orprocedure')->get(),
                'orsupply' => Item::where('section','orsupply')->get(),
                'orfluid' => Item::where('section','orfluid')->get(),
                'orsuture' => Item::where('section','orsuture')->get(),
                'ormedicine' => Item::where('section','ormedicine')->get(),
                'patient' => $patient

            ]);
        }else if($area=='OPD'){
            return view('page.update3',[
                'title' => 'Update Charges',
                'id' => $id,
                'opdcharges' => Item::where('section','opdcharges')->get(),
                'opdothers' => Item::where('section','opdothers')->get(),
                'patient' => $patient
            ]);
        }
    }

    public function generateSerial($area,$id)
    {
        $number = 0;
        $check = Serial::where('patient_id',$id)
                    ->where('area',$area)
                    ->first();
        if(!$check){
            $last = Serial::where('area',$area)
                ->orderBy('id','desc')
                ->first();
            if($last)
            {
                $number = $last->number;
            }
            $number += 1;
            Serial::create([
                'patient_id' => $id,
                'year' => date('y'),
                'number' => $number,
                'area' => $area
            ]);
        }
    }

    public function saveDraft(Request $req,$id)
    {
        Draft::where('patient_id',$id)->delete();
        $area = Patient::find($id)->area;
        self::generateSerial($area,$id);

        $items = $req->items;
        foreach($items as $item => $value)
        {
            if($value > 0 || $value=='on'){
                $data = array(
                    'patient_id' => $id,
                    'item_id' => $item,
                    'qty' => $value
                );
                Draft::create($data);
            }

        }
        Patient::where('id',$id)
            ->update([
                'status' => 1
            ]);
        $patient = Patient::find($id);
        $name = "$patient->fname $patient->lname";
        Log::create('Generate Charges',"Create/update charges of $name");
        return redirect('charges/print/'.$id);
    }

    static function getAmount($patient_id, $item_id)
    {
        $draft = Draft::where('patient_id',$patient_id)
                    ->where('item_id',$item_id)
                    ->first();
        if($draft){
            if($draft->qty==0){
                return Item::find($item_id)->amount;
            }
            $amount = Item::find($item_id)->amount;
            return $amount * $draft->qty;
        }


        return null;
    }

    public function showPrint($id)
    {
        $area = Patient::find($id)->area;
        if($area=='OPD')
            return redirect('/charges/update/'.$id)->with('status','print');

        $orcharge = Draft::join('items','items.id','=','drafts.item_id')
                    ->where('items.section','orcharge')
                    ->where('drafts.patient_id',$id)
                    ->get();

        $orprocedure = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','orprocedure')
            ->get();

        $orsupply = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','orsupply')
            ->get();

        $orsuture = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','orsuture')
            ->get();

        $orfluid = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','orfluid')
            ->get();

        $ormedicine = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','ormedicine')
            ->get();


        $fixed = Draft::join('items','items.id','=','drafts.item_id')
                    ->where('items.section','fixed')
                    ->where('drafts.patient_id',$id)
                    ->get();

        $room = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','room')
            ->get();

        $procedure = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','procedure')
            ->get();

        $supplies = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','supplies')
            ->get();

        $equipment = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','equipment')
            ->get();

        $gas = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','gas')
            ->get();

        $outsource = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','outsource')
            ->get();

        $others = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','others')
            ->get();

        $ancillary = Draft::join('items','items.id','=','drafts.item_id')
            ->select('drafts.qty as final_qty','items.*')
            ->where('drafts.patient_id',$id)
            ->where('items.section','ancillary')
            ->get();

        $patient = Patient::find($id);

        $name = "$patient->fname $patient->lname";
        Log::create('Print Charges',"Print charges of $name");
        return view('page.print',[
            'title' => 'Summary of Charges',
            'id' => $id,
            'fixed' => $fixed,
            'room' => $room,
            'procedure' => $procedure,
            'supplies' => $supplies,
            'equipment' => $equipment,
            'gas' => $gas,
            'outsource' => $outsource,
            'others' => $others,
            'ancillary' => $ancillary,
            'patient' => $patient,
            'orcharge' => $orcharge,
            'orprocedure' => $orprocedure,
            'orsupply' => $orsupply,
            'orfluid' => $orfluid,
            'orsuture' => $orsuture,
            'ormedicine' => $ormedicine,
            'total' => 0
        ]);
    }

    static function checkItem($patient_id,$item_id)
    {
        $check = Draft::where('patient_id',$patient_id)
                    ->where('item_id',$item_id)
                    ->first();
        if($check)
            return $check->qty;

        return false;
    }
}
