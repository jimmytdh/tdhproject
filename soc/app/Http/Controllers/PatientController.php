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
        $user = Session::get('user');
        $keyword = Session::get('search_patient');

        $sort = Session::get('sort');

        $patients = Patient::select('*');
        if($user->level == 0)
        {
            $patients = $patients->where('area',strtoupper($user->area));
        }
        if($keyword)
        {
            $patients = $patients->where(function($q) use ($keyword) {
                    $q->where('fname','like',"%$keyword%")
                        ->orwhere('lname','like',"%$keyword%")
                        ->orwhere('hospital_no','like',"%$keyword%");
                });
        }

        if($sort)
        {
            $patients = $patients->orderBy($sort->name,$sort->order);
        }

        $patients = $patients->orderBy('id','desc')->paginate(20);
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

    public function sort($sort)
    {
        $session = Session::get('sort');
        $data = array(
            'name' => $sort,
            'order' => 'asc'
        );
        if($session)
        {
            if($session->name==$sort){
                if($session->order=='asc'){
                    $data = array(
                        'name' => $sort,
                        'order' => 'desc'
                    );
                }else{
                    $data = array(
                        'name' => $sort,
                        'order' => 'asc'
                    );
                }
            }
        }
        $data = (object)$data;
        Session::put('sort',$data);

        print_r($data->order);
        return redirect('/patients');
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
        $patient = Patient::create($data);

        Log::create('Add Patient',"Added a new patient $req->fname $req->lname");
        return redirect('charges/generate/'.$patient->id);
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
