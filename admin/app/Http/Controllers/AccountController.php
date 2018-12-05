<?php

namespace App\Http\Controllers;

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
        return view('accounts.index',[
            'title' => 'User Accounts',
            'data' => array()
        ]);
    }

    public function add()
    {
        return view('accounts.add',[
            'title' => 'Add Account',
            'data' => array()
        ]);
    }
}
