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

//Manage Sections
Route::get('/sections','SectionController@index');
Route::get('/sections/add','SectionController@add');
Route::post('/sections/save','SectionController@save');

//Update administrator account
Route::post('system/update','MainController@update');

//Homepage of admin
Route::get('/home','HomeController@index');

