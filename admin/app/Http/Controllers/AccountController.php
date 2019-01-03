<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Section;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('login');
    }

    public function index()
    {
        $data = User::select(
            'profiles.*',
            'sections.name as section',
            'divisions.name as division'
        )
            ->join('profiles','profiles.id','=','users.prof_id')
            ->join('sections','sections.id','=','users.sec_id')
            ->join('divisions','divisions.id','=','users.div_id')
            ->where("users.level",0)
            ->orderBy('profiles.lname','asc')
            ->get();

        return view('accounts.index',[
            'title' => 'User Accounts',
            'data' =>$data
        ]);
    }

    public function add()
    {
        return view('accounts.add',[
            'title' => 'Add Account',
            'data' => array()
        ]);
    }

    public function edit($id)
    {
        $data = User::select(
                'profiles.*',
                'users.username',
                'users.email',
                'users.sec_id'
            )
            ->join('profiles','profiles.id','=','users.prof_id')
            ->where('profiles.id',$id)
            ->first();
        return view('accounts.update',[
            'title' => 'Update Account',
            'data' => $data
        ]);
    }

    public function save(Request $req)
    {
        $match = array(
            'fname' => ucwords(mb_strtolower($req->fname)),
            'mname' => ucwords(mb_strtolower($req->mname)),
            'lname' => ucwords(mb_strtolower($req->lname)),
            'ext' => ucwords(mb_strtolower($req->ext)),
            'dob' => date('Y-m-d',strtotime($req->dob))
        );
        $profile = array(
            'sex' => $req->sex,
            'address' => ucwords(mb_strtolower($req->address)),
            'contact' => $req->contact,
            'blood_type' => strtoupper($req->blood_type),
            'hospital_id' => $req->hospital_id,
            'tin' => $req->tin,
            'gsis' => $req->gsis,
            'phic' => $req->phic,
            'pagibig' => $req->pagibig,
            'designation' => $req->designation,
            'e_fname' => ucwords(mb_strtolower($req->e_fname)),
            'e_mname' => ucwords(mb_strtolower($req->e_mname)),
            'e_lname' => ucwords(mb_strtolower($req->e_lname)),
            'e_address' => ucwords(mb_strtolower($req->e_address)),
            'e_contact' => $req->e_contact
        );

        $profile = Profile::updateOrCreate($match,$profile);
        $prof_id = $profile->id;

        $div_id = Section::find($req->section)->div_id;

        $match = array(
            'prof_id' => $prof_id
        );
        $user = array(
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'email' => $req->email,
            'level' => 0,
            'sec_id' => $req->section,
            'div_id' => $div_id
        );
        User::updateOrCreate($match,$user);

        return $profile['fname'].' '.$profile['lname'].' successfully added!';
    }

    public function update(Request $req)
    {
        $id = $req->prof_id;
        $profile = array(
            'fname' => ucwords(mb_strtolower($req->fname)),
            'mname' => ucwords(mb_strtolower($req->mname)),
            'lname' => ucwords(mb_strtolower($req->lname)),
            'ext' => ucwords(mb_strtolower($req->ext)),
            'dob' => date('Y-m-d',strtotime($req->dob)),
            'sex' => $req->sex,
            'address' => ucwords(mb_strtolower($req->address)),
            'contact' => $req->contact,
            'blood_type' => strtoupper($req->blood_type),
            'hospital_id' => $req->hospital_id,
            'tin' => $req->tin,
            'gsis' => $req->gsis,
            'phic' => $req->phic,
            'pagibig' => $req->pagibig,
            'designation' => $req->designation,
            'e_fname' => ucwords(mb_strtolower($req->e_fname)),
            'e_mname' => ucwords(mb_strtolower($req->e_mname)),
            'e_lname' => ucwords(mb_strtolower($req->e_lname)),
            'e_address' => ucwords(mb_strtolower($req->e_address)),
            'e_contact' => $req->e_contact
        );

        Profile::where('id',$id)
            ->update($profile);

        $div_id = Section::find($req->section)->div_id;

        $user = array(
            'email' => $req->email,
            'level' => 0,
            'sec_id' => $req->section,
            'div_id' => $div_id
        );

        if($req->password)
        {
            $user['password'] = bcrypt($req->password);
        }

        User::where('prof_id',$id)
            ->update($user);

        return $profile['fname'].' '.$profile['lname'].' successfully updated!';
    }
}
