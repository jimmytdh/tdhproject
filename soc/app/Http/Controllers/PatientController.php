<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController as Log;

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
        $data = array(
            'hospital_no' => $req->hospital_no,
            'lname' => $req->lname,
            'fname' => $req->fname,
            'age' => $req->age,
            'sex' => $req->sex,
            'phic' => $req->phic,
            'area' => $req->area,
            'status' => 0
        );
        Patient::create($data);

        Log::create('Add Patient',"Added a new patient $req->fname $req->lname");
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

        Log::create('Update Patient',"Updated patient $req->fname $req->lname");
        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        $patient = Patient::find($id);
        Log::create('Delete Patient',"Deleted patient $patient->fname $patient->lname");
        Patient::where('id',$id)->delete();
        return redirect()->back()->with('status','deleted');
    }
}
