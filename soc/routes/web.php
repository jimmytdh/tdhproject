<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Homepage of admin
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/home/data', 'HomeController@data');
Route::get('/summary', 'HomeController@summary');


Route::get('/login','MainController@login');
Route::post('/login','MainController@validateLogin');
Route::get('/logout', function (){
    Session::flush();
    return redirect('login');
});



//Manage Items
Route::post('/item/save','ItemController@save')->middleware('admin');
Route::post('/item/update','ItemController@update')->middleware('admin');
Route::get('/item/edit/{id}','ItemController@edit')->middleware('admin');
Route::get('/item/delete/{id}','ItemController@delete')->middleware('admin');

//Manage Charges
Route::get('/charges','ItemController@index')->middleware('admin');
Route::get('/charges/generate/{id}','ItemController@generate');
Route::post('/charges/print/{id}','ItemController@saveDraft');
Route::get('/charges/print/{id}','ItemController@showPrint');
Route::get('/charges/update/{id}','ItemController@updateCharges');

Route::get('/orcharges','ItemController@index2')->middleware('admin');
//Route::get('/charges/print/{id}','ItemController@showPrint');
//Route::get('/charges/update/{id}','ItemController@updateCharges');

//Manage OPD Charges
Route::get('/opdcharges','ItemController@index3')->middleware('admin');
Route::get('/print/opd/{id}','PrintController@printOpdSoa');
//Route::get('/opdcharges/update/{id}','ItemController@updateCharges');

//Manage Patients
Route::get('/patients','PatientController@index');
Route::post('/patient/save','PatientController@save');
Route::post('/patients/search','PatientController@search');
Route::get('/patient/edit/{id}','PatientController@edit');
Route::get('/patient/delete/{id}','PatientController@delete');
Route::post('/patient/update','PatientController@update');

Route::get('/patients/sort/{sort}','PatientController@sort');

//Manage Logs
Route::get('/logs','LogController@index');
Route::post('/logs/filter','LogController@filter');

//Manage Users
Route::get('/users','LoginController@index');
Route::post('/users/save','LoginController@save');
Route::get('/users/edit/{id}','LoginController@edit');
Route::post('/users/update/{id}','LoginController@update');
Route::get('/users/delete/{id}','LoginController@delete');
Route::post('/users/search','LoginController@search');

Route::get('/print','PrintController@printSoa');


Route::get('/test',function (){
    $data = \App\Homis::orderBy('hpercode','desc')->limit(10)->get();
    foreach($data as $key => $value)
    {
        echo $value.'<br>';
    }
});

Route::get('sample/{area}/{start}/{end}','HomeController@countPatientChart2');


