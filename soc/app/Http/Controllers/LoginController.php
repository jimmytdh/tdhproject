<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
        $this->middleware('admin');
    }

    public function index()
    {
        $keyword = Session::get('search_user');

        $logins = Login::select('*');
        if($keyword)
        {
            $logins = $logins->where(function($q) use ($keyword){
                $q->where('fname','like',"%$keyword%")
                    ->orwhere('lname','like',"%$keyword%")
                    ->orwhere('username','like',"%$keyword%");
            });
        }
        $logins = $logins->orderBy('lname','asc')
                    ->paginate(20);

        return view('page.users',[
            'title' => 'List of Users',
            'logins' => $logins,
            'post' => 'users/search',
            'keyword' => $keyword,
            'edit' => false
        ]);
    }

    public function edit($id)
    {
        $keyword = Session::get('search_user');

        $logins = Login::select('*');
        if($keyword)
        {
            $logins = $logins->where(function($q) use ($keyword){
                $q->where('fname','like',"%$keyword%")
                    ->orwhere('lname','like',"%$keyword%")
                    ->orwhere('username','like',"%$keyword%");
            });
        }
        $logins = $logins->orderBy('lname','asc')
            ->paginate(20);

        $info = Login::find($id);

        return view('page.users',[
            'title' => 'Update Users',
            'logins' => $logins,
            'post' => 'users/search',
            'keyword' => $keyword,
            'info' => $info,
            'edit' => true
        ]);
    }

    public function save(Request $req)
    {
        $check = Login::where('username',$req->username)->first();
        $admin = strtoupper($req->username);
        if($admin=='ADMIN')
            return redirect()->back()->with('status','denied');

        if($check)
            return redirect()->back()->with('status','duplicate');

        $data = array(
            'fname' => $req->fname,
            'lname' => $req->lname,
            'level' => $req->level,
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'area' => $req->area
        );

        Login::create($data);

        return redirect()->back()->with('status','saved');

    }

    public function update(Request $req,$id)
    {
        $check = Login::where('username',$req->username)
            ->where('id','!=',$id)
            ->first();

        $admin = strtoupper($req->username);
        if($admin=='ADMIN')
            return redirect()->back()->with('status','denied');

        if($check)
            return redirect()->back()->with('status','duplicate');

        $data = array(
            'fname' => $req->fname,
            'lname' => $req->lname,
            'level' => $req->level,
            'username' => $req->username,
            'area' => $req->area
        );

        if($req->password)
            $data['password'] = bcrypt($req->password);

        Login::find($id)->update($data);

        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        Login::find($id)->delete();
        return redirect('/users')->with('status','deleted');
    }

    public function search(Request $req)
    {
        Session::put('search_user',$req->search);
        return redirect('users');
    }
}
