<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index()
    {
        $keyword = Session::get('search_patient');
        $patients = Patient::orderBy('id','desc');
        if($keyword)
        {
            $patients = $patients->where(function($q) use ($keyword) {
                    $q->where('fname','like',"%$keyword%")
                        ->orwhere('lname','like',"%$keyword%")
                        ->orwhere('hospital_no','like',"%$keyword%");
                });
        }
        $patients = $patients->paginate(20);
        return view('page.patients',[
            'title' => 'List of Patients',
            'patients' => $patients,
            'post' => 'patients/search',
            'keyword' => $keyword
        ]);
    }

    public function search(Request $req)
    {
        Session::put('search_patient',$req->search);
        return redirect('patients');
    }

    public function save(Request $req)
    {
        Patient::create([
            'hospital_no' => $req->hospital_no,
            'lname' => $req->lname,
            'fname' => $req->fname,
            'age' => $req->age,
            'sex' => $req->sex,
            'phic' => $req->phic,
            'area' => $req->area,
            'status' => 0
        ]);

        return redirect()->back()->with('status','added');
    }

    public function edit($id)
    {
        return Patient::find($id);
    }

    public function update(Request $req)
    {
        Patient::where('id',$req->id)
            ->update([
                'hospital_no' => $req->hospital_no,
                'lname' => $req->lname,
                'fname' => $req->fname,
                'age' => $req->age,
                'sex' => $req->sex,
                'phic' => $req->phic,
                'area' => $req->area
            ]);

        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        Patient::where('id',$id)->delete();
        return redirect()->back()->with('status','deleted');
    }
}
