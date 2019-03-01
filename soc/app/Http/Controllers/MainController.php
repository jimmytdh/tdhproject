<?php

namespace App\Http\Controllers;

use App\Greeting;
use App\Login;
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
        $check = User::where('level','admin')->first();
        if($check)
            return true;
        return false;
    }

    public function update(Request $req)
    {
        $login = array(
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'level' => 'admin'
        );


        $data['login'] = $login;

        User::create($login);

        return redirect('/');
    }

    public function login()
    {
        $isLogin = Session::get('isLogin');
        if($isLogin)
            return redirect('/');

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
                if($login->level==0)
                    return redirect('/login?q=denied');

                $profile = Profile::find($login->prof_id);
                $login->area = 'all';
                Session::put('user',$login);
                Session::put('profile',$profile);
                Session::put('isLogin',true);

                return redirect('/home');

            }else{
                return redirect('/login?q=error');
            }
        }else{
            $login = Login::where('username',$req->username)->first();
            if($login)
            {
                if(Hash::check($req->password,$login->password))
                {
                    $profile = array(
                        'fname' => $login->fname,
                        'lname' => $login->lname,
                        'picture' => 'logo.png'
                    );
                    $profile = (object)$profile;

                    Session::put('user',$login);
                    Session::put('profile',$profile);
                    Session::put('isLogin',true);

                    return redirect('/home');

                }else{
                    return redirect('/login?q=error');
                }
            }
        }

        return redirect('/login?q=empty');
    }

}
