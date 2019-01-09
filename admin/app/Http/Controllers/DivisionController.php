<?php

namespace App\Http\Controllers;

use App\Division;
use App\Profile;
use App\Section;
use App\User;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('login');
    }

    public function index()
    {
        $data = Division::select(
            'divisions.*',
            'profiles.fname',
            'profiles.lname'
        )
            ->leftJoin('profiles','profiles.id','=','divisions.head_id')
            ->orderBy('divisions.code','asc')
            ->get();

        return view('divisions.index',[
            'title' => 'List of Divisions',
            'data' => $data
        ]);
    }

    static function countPersonnel($div_id)
    {
        $count = User::where('div_id',$div_id)->count();
        return $count;
    }

    static function countSection($div_id)
    {
        $count = Section::where('div_id',$div_id)->count();
        return $count;
    }

    public function add()
    {
        $profiles = Profile::select('profiles.*')
                    ->join('users','users.prof_id','=','profiles.id')
                    ->where('users.level',0)
                    ->orderBy('lname','asc')
                    ->get();

        return view('divisions.add',[
            'title' => 'Add Division',
            'profiles' => $profiles
        ]);
    }

    public function save(Request $req)
    {
        $data = array(
            'code' => mb_strtoupper($req->code),
            'name' => ucwords(mb_strtolower($req->name)),
            'head_id' => $req->head_id
        );
        $match = array(
            'code' => mb_strtoupper($req->code)
        );

        $division = Division::updateOrCreate($match,$data);
        if($division->wasRecentlyCreated){
            return redirect()->back()->with('status','added');
        }
        return redirect()->back()->with('status','updated');
    }

    public function edit($id)
    {
        $data = Division::select(
                    'divisions.*',
                    'profiles.fname',
                    'profiles.lname'
                )
                ->leftJoin('profiles','profiles.id','=','divisions.head_id')
                ->where('divisions.id',$id)
                ->first();
        $profiles = Profile::select('profiles.*')
            ->join('users','users.prof_id','=','profiles.id')
            ->where('users.level',0)
            ->where('users.div_id',$id)
            ->orderBy('lname','asc')
            ->get();
        return view('divisions.edit',[
            'title' => 'Update Division',
            'profiles' => $profiles,
            'data' => $data
        ]);
    }

    public function update(Request $req)
    {
        $data = array(
            'code' => mb_strtoupper($req->code),
            'name' => ucwords(mb_strtolower($req->name)),
            'head_id' => $req->head_id
        );
        $match = array(
            'id' => $req->id
        );

        $division = Division::updateOrCreate($match,$data);

        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        $count = User::where('div_id',$id)->count();
        if($count > 0)
            return redirect()->back()->with('status','denied');

        Division::where('id',$id)->delete();
        return redirect('divisions')->with('status','deleted');
    }
}
