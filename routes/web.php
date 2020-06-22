<?php

use Illuminate\Support\Facades\Route;

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


Route::match(array('GET', 'DELETE'), "/files", "FileController@index");
Route::post("/upload", "FileController@store");
Route::get("/files/{id}", "FileController@show");
Route::delete("/files/delete/{id}", "FileController@destroy")->name('delete');
Route::get("/download/{id}/{originalName}", "DownloadsController@index");
