<?php

namespace App\Http\Controllers;

use App\Division;
use App\Profile;
use App\Section;
use App\User;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('login');
    }

    public function index()
    {
        $data = Section::select(
                'sections.*',
                'profiles.fname',
                'profiles.lname',
                'divisions.name as division'
            )
            ->join('divisions','divisions.id','=','sections.div_id')
            ->leftJoin('profiles','profiles.id','=','sections.head_id')
            ->orderBy('sections.code','asc')
            ->get();

        return view('sections.index',[
            'title' => 'List of Sections/Departments',
            'data' => $data
        ]);
    }

    static function countPersonnel($sec_id)
    {
        $count = User::where('sec_id',$sec_id)->count();
        return $count;
    }

    public function add()
    {
        $division = Division::orderBy('name','asc')->get();
        $profiles = Profile::select(
                'profiles.*'
            )
            ->join('users','users.prof_id','=','profiles.id')
            ->where('users.level',0)
            ->orderBy('lname','asc')
            ->get();
        return view('sections.add',[
            'title' => 'Add Section/Department',
            'division'=> $division,
            'profiles' => $profiles
        ]);
    }

    public function save(Request $req)
    {
        $data = array(
            'code' => mb_strtoupper($req->code),
            'name' => ucwords(mb_strtolower($req->name)),
            'head_id' => $req->head_id,
            'div_id' => $req->division
        );
        $match = array(
            'code' => mb_strtoupper($req->code)
        );

        $section = Section::updateOrCreate($match,$data);
        if($section->wasRecentlyCreated){
            return redirect()->back()->with('status','added');
        }
        return redirect()->back()->with('status','updated');
    }

    public function edit($id)
    {
        $data = Section::find($id);

        $profiles = Profile::select(
                'profiles.*'
            )
            ->join('users','users.prof_id','=','profiles.id')
            ->where('users.level',0)
            ->where('users.sec_id',$id)
            ->orderBy('lname','asc')
            ->get();

        $division = Division::orderBy('name','asc')->get();

        return view('sections.edit',[
            'title' => 'Update Section',
            'profiles' => $profiles,
            'data' => $data,
            'divisions' => $division
        ]);
    }

    public function update(Request $req)
    {
        $data = array(
            'code' => mb_strtoupper($req->code),
            'name' => ucwords(mb_strtolower($req->name)),
            'head_id' => $req->head_id,
            'div_id' => $req->division
        );
        $match = array(
            'id' => $req->id
        );

        Section::updateOrCreate($match,$data);

        User::where('sec_id',$req->id)
            ->where('div_id','!=',$req->division)
            ->update([
                'div_id' => $req->division
            ]);

        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        $count = User::where('sec_id',$id)->count();
        if($count > 0)
            return redirect()->back()->with('status','denied');

        Section::where('id',$id)->delete();
        return redirect('sections')->with('status','deleted');
    }
}
