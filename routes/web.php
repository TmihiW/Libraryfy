<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
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



// in http://127.0.0.1:8000/hello
Route::get('/hello', function () {
    return response('<h1>Hello World</h1>', 200)
        ->header('Content-Type', 'text/plain')
        ->header('foo', 'bar');
});

// in http://127.0.0.1:8000/posts/1
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


// // any http request can be used here Route::
// Route::get('/', function () {
//     //return view('pdfViewer');
//     //return view('welcome');

//     //pass data to view
//     return view('listings',[
//         'listingsValues'=> Listing::all() //double column :: is used to call static methods
//         //data come throught a model, in laravel we called eloquent model wich is ORM (Object Relational Mapper)
//         //to create an eloquent model run this comand in terminal:
//         //php artisan make:model Listing
//     ]);
// });


// // in http://127.0.0.1:8000/listings/1
// //single listing
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);
//     if ($listing){
//         return view('listing',[
//             'listingValue'=> Listing::find($id)
//         ]);
//     }
//     else{
//         abort('404');
//         //return redirect('/');
//     }

// });

Route::get('/', [ListingController::class, 'index']);

Route::get('/listings/{id}', [ListingController::class, 'show']);

//Common Resource Routes:
//index - Show all listings
//show - Show a single listing
//create - Show form to create new listing
//store - Save new listing
//edit - Show form to edit listing
//update - Update listing
//destroy - Delete listing