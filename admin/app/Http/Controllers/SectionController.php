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
            'title' => 'List of Sections',
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
        $profiles = Profile::orderBy('lname','asc')->get();
        return view('sections.add',[
            'title' => 'Add Section',
            'division'=> $division,
            'profiles' => $profiles
        ]);
    }

    public function save(Request $req)
    {
        $data = array(
            'code' => ucwords(mb_strtolower($req->code)),
            'name' => ucwords(mb_strtolower($req->name)),
            'div_id' => $req->division
        );
        print_r($data);
    }
}
