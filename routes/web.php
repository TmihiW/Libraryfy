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

// any http request can be used here Route::
Route::get('/', function () {
    //return view('pdfViewer');
    return view('welcome');
});

// in http://127.0.0.1:8000/hello
Route::get('/hello', function () {
    return 'Hello World';
});