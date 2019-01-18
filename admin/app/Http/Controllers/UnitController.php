<?php

namespace App\Http\Controllers;

use App\Division;
use App\Profile;
use App\Section;
use App\Unit;
use App\User;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('login');
    }

    public function index()
    {
        $data = Unit::select(
            'units.*',
            'profiles.fname',
            'profiles.lname',
            'divisions.name as division',
            'sections.name as section'
        )
            ->join('divisions','divisions.id','=','units.div_id')
            ->join('sections','sections.id','=','units.sec_id')
            ->leftJoin('profiles','profiles.id','=','units.head_id')
            ->orderBy('units.code','asc')
            ->get();

        return view('units.index',[
            'title' => 'List of Units',
            'data' => $data
        ]);
    }

    static function countPersonnel($unit_id)
    {
        $count = User::where('unit_id',$unit_id)->count();
        return $count;
    }

    public function add()
    {
        $profiles = Profile::select(
                'profiles.*'
            )
            ->join('users','users.prof_id','=','profiles.id')
            ->where('users.level',0)
            ->orderBy('lname','asc')
            ->get();

        return view('units.add',[
            'title' => 'Add Unit',
            'profiles' => $profiles
        ]);
    }

    public function save(Request $req)
    {
        $division = Section::find($req->section)->first()->div_id;
        $data = array(
            'code' => mb_strtoupper($req->code),
            'name' => ucwords(mb_strtolower($req->name)),
            'head_id' => $req->head_id,
            'sec_id' => $req->section,
            'div_id' => $division
        );
        $match = array(
            'code' => mb_strtoupper($req->code)
        );

        $section = Unit::updateOrCreate($match,$data);
        if($section->wasRecentlyCreated){
            return redirect()->back()->with('status','added');
        }
        return redirect()->back()->with('status','updated');
    }

    public function edit($id)
    {
        $data = Unit::find($id);

        $profiles = Profile::select(
            'profiles.*'
        )
            ->join('users','users.prof_id','=','profiles.id')
            ->where('users.level',0)
            ->where('users.unit_id',$id)
            ->orderBy('lname','asc')
            ->get();

        return view('units.edit',[
            'title' => 'Update Unit',
            'profiles' => $profiles,
            'data' => $data
        ]);
    }

    public function update(Request $req)
    {
        $division = Section::find($req->section)->div_id;
        $data = array(
            'code' => mb_strtoupper($req->code),
            'name' => ucwords(mb_strtolower($req->name)),
            'head_id' => $req->head_id,
            'sec_id' => $req->section,
            'div_id' => $division
        );
        $match = array(
            'id' => $req->id
        );

        Unit::updateOrCreate($match,$data);

        User::where('unit_id',$req->id)
            ->update([
                'sec_id' => $req->section,
                'div_id' => $division
            ]);

        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        $count = User::where('unit_id',$id)->count();
        if($count > 0)
            return redirect()->back()->with('status','denied');

        Unit::where('id',$id)->delete();
        return redirect('units')->with('status','deleted');
    }

    public function json($sec_id)
    {
        return Unit::where('sec_id',$sec_id)->get();
    }
}
