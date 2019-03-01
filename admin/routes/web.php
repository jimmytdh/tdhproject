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

Route::get('/', 'MainController@index');

Route::get('/login','MainController@login');
Route::post('/login','MainController@validateLogin');
Route::get('/logout', function (){
    Session::flush();
    return redirect('login');
});

//Accounts page
Route::get('/accounts','AccountController@index');
Route::get('/accounts/add','AccountController@add');
Route::post('/accounts/save','AccountController@save');

Route::get('/accounts/update/{id}','AccountController@edit');
Route::post('/accounts/update','AccountController@update');
Route::post('/accounts/upload/{id}','AccountController@upload');
Route::get('/accounts/delete/{id}','AccountController@delete');

//Manage Sections
Route::get('/units','UnitController@index');
Route::get('/units/add','UnitController@add');
Route::post('/units/save','UnitController@save');
Route::get('/units/update/{id}','UnitController@edit');
Route::post('/units/update','UnitController@update');
Route::get('/units/delete/{id}','UnitController@delete');
Route::get('units/json/{sec_id}','UnitController@json');

//Manage Sections
Route::get('/sections','SectionController@index');
Route::get('/sections/add','SectionController@add');
Route::post('/sections/save','SectionController@save');
Route::get('/sections/update/{id}','SectionController@edit');
Route::post('/sections/update','SectionController@update');
Route::get('/sections/delete/{id}','SectionController@delete');

//Manage Divisions
Route::get('/divisions','DivisionController@index');
Route::get('/divisions/add','DivisionController@add');
Route::post('/divisions/save','DivisionController@save');
Route::get('/divisions/update/{id}','DivisionController@edit');
Route::post('/divisions/update','DivisionController@update');
Route::get('/divisions/delete/{id}','DivisionController@delete');

//Manage IP Addresses
Route::get('/ipuser','IPController@index');
Route::get('/ipuser/edit/{id}','IPController@edit');
Route::post('/ipuser/update','IPController@update');

//Update administrator account
Route::post('system/update','MainController@update');

//Homepage of admin
Route::get('/home','HomeController@index');


Route::get('sample',function (){
    return view('sample');
});
