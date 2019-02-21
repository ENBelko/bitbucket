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

Route::get('/', function () {
    $content = \Illuminate\Support\Facades\DB::table('content')->first();

    return view('welcome',compact('content'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::Post('/admin/edit', 'AdminController@edit')->name('admin.edit');
Route::Post('/admin/event/delete', 'AdminController@eventDelete')->name('admin.event.delete');

Route::Post('/event/store', 'EventController@store')->name('event.store');
