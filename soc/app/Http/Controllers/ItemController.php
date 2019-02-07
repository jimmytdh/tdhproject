<?php

namespace App\Http\Controllers;

use App\Draft;
use App\Item;
use App\Patient;
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
            'title' => 'Create/Update Charges'
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

        ]);
    }

    public function updateCharges($id)
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

        ]);
    }

    public function saveDraft(Request $req,$id)
    {
        Draft::where('patient_id',$id)->delete();

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

    public function showPrint($id)
    {
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
