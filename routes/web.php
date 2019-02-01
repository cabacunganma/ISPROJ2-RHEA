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

//Route::get('/users/{name}/{id}', function ($name, $id){
//    return 'This is user '.$name.' with an id of '.$id;
//});

//Route::get('/about', function (){
//    return view('pages.about');
//});

//PagesController
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

//PostsController
Route::resource('posts', 'PostsController');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//Admin
Route::get('/admin/dashboard', 'AdminsController@dashboard');
Route::get('/profile', 'AdminsController@profile');

//Admin-CRUD DOCTORS
Route::resource('users', 'CrudDoctorController');

//Reset Password
//Route::get('/dashboard', 'ResetPaswordController@index');
