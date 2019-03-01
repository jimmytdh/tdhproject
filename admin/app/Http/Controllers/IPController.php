<?php

namespace App\Http\Controllers;

use App\IP;
use Illuminate\Http\Request;

class IPController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('login');
    }

    public function index()
    {
        return view('page.ip',[
            'title' => 'IP Address User',
            'static' => IP::where('ip_type','static')->orderBy('ip_address','asc')->get(),
            'homis' => IP::where('ip_type','homis')->orderBy('ip_address','asc')->get(),
        ]);
    }

    public function edit($id)
    {
        return IP::find($id);
    }

    public function update(Request $req)
    {
        $data = array(
            'fname' => $req->fname,
            'lname' => $req->lname,
            'section' => $req->section
        );
        IP::find($req->id)
            ->update($data);

        return redirect()->back()->with('status','updated');
    }
}
