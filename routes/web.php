<?php

use Illuminate\Http\Request;
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
    return response('<h1>Hello World</h1>', 200)
        ->header('Content-Type', 'text/plain')
        ->header('foo', 'bar');
});

// ->where('id', '[0-9]+') is a regular expression
Route::get('/posts/{id}', function ($id) {
    //dump and die function
    //output: "1" // routes\web.php:32
    dd($id);
    //dump die and debug function
    //ddd($id);
    return response('This is post number ' . $id);
})->where('id', '[0-9]+');


// access values directly
//in http://127.0.0.1:8000/search?name=Kadir&city=Kayseri
Route::get('/search', function (Request $request) {
    //dd($request);
    return $request->name.' '.$request->city;
});
