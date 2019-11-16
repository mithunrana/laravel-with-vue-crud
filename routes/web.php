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
    return view('welcome');
});

Route::get('biodata', 'BiodataController@getData');
Route::post('biodatastore', 'BiodataController@biodataStore');
Route::get('allbiodata', 'BiodataController@getIndex');
Route::post('biodataupdate', 'BiodataController@biodataUpdate');
Route::post('biodatadelette', 'BiodataController@biodataDelete');
