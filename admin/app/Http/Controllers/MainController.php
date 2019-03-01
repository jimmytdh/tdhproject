<?php

namespace App\Http\Controllers;

use App\Greeting;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $checkAdmin = self::checkAdmin();
        if(!$checkAdmin)
            return view('update');
        else
            return self::login();
    }

    public function checkAdmin()
    {
        $check = User::where('level',1)->first();
        if($check)
            return true;
        return false;
    }

    public function update(Request $req)
    {
        $profile = array(
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
            'designation' => $req->designation
        );
        $login = array(
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'level' => 1
        );

        $data['profile'] = $profile;
        $data['login'] = $login;

        $profile = Profile::create($profile);
        $login['prof_id'] = $profile->id;
        User::create($login);

        return redirect('/');
    }

    public function login()
    {
        $greetings = Greeting::inRandomOrder()->first();
        return view('login',[
            'greetings' => $greetings
        ]);
    }

    public function validateLogin(Request $req)
    {
        $login = User::where('username',$req->username)->first();
        if($login)
        {
            if(Hash::check($req->password,$login->password))
            {
                $profile = Profile::find($login->prof_id);
                Session::put('user',$login);
                Session::put('profile',$profile);
                Session::put('isLogin',true);
                if($login->level==1)
                {
                    return redirect('/home');
                }else{
                    return 'proceed to portal';
                }
            }else{
                return redirect('/login?q=error');
            }
        }

        return redirect('/login?q=empty');
    }


}
