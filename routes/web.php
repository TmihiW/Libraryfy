<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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
//Common Resource Routes:
//index - Show all listings
//show - Show a single listing
//create - Show form to create new listing
//store - Save new listing
//edit - Show form to edit listing
//update - Update listing
//destroy - Delete listing

/*
* 
*          Users Routes
*
*/


//All listings
Route::get('/laragigs/', [ListingController::class, 'indexView'])->middleware('auth');

//Show Create Form
Route::get('/laragigs/listings/create', [ListingController::class, 'createView'])->middleware('auth');

//Store new listing
Route::post('/laragigs/listings', [ListingController::class, 'saveRequest'])->middleware('auth');

//Show Edit Form
Route::get('/laragigs/listings/{listing}/edit', [ListingController::class, 'editView'])->middleware('auth');

//in order to submit the form we need to use PUT method
//Update listing
Route::put('/laragigs/listings/{listing}', [ListingController::class, 'updateRequest'])->middleware('auth');

//Delete listing
Route::delete('/laragigs/listings/{listing}', [ListingController::class, 'deleteRequest'])->middleware('auth');

//Manage Listings
Route::get('/laragigs/listings/manage', [ListingController::class, 'manageView'])->middleware('auth');

//Must to be before /laragigs/listings/{id} route to prevent conflict
//Single Listing
Route::get('/laragigs/listings/{id}', [ListingController::class, 'showView'])->middleware('auth');


/**************************************************************/
/**************************************************************/
/**************************************************************/
/************  **  **      **      **    ****      ************/
/************  **  **  ******  ******  **  **  ****************/
/************  **  **      **      **  **  **      ************/
/************  **  ******  **  ******    ********  ************/
/************      **      **      **  **  **      ************/
/**************************************************************/
/**************************************************************/
/**************************************************************/
//                  squint your eyes to see


//Show Register
//Route::get('/laragigs/register', [UsersController::class, 'laragigsRegisterView']);
Route::get('/register', [UserController::class, 'registerView'])->middleware('guest');

//Create new user for listing
//Route::post('/laragigs/users', [UsersController::class, 'laragigsSaveRequest']);
//Create new user for Libraryfy
Route::post('/users', [UserController::class, 'saveRegisterRequest'])->middleware('guest');

Route::get('/', [UserController::class, 'userIndexView']);

////$user_id changed in $id in database table but not in route
////and different from UserController.php that is $u_id
Route::get('/listings/{u_id}', [UserController::class, 'userShowView']);


//Log user out
Route::post('/logout', [UserController::class, 'logoutRequest'])->middleware('auth');

//Show Login form
Route::get('/login', [UserController::class, 'loginView'])->name('login')->middleware('guest');

//Log user in
Route::post('/users/authenticate', [UserController::class, 'authenticateRequest']);


/**************************************************************/
/**************************************************************/
/**************************************************************/
/************      **      **      **  **  ***      ***********/
/************  **  **  **  **  **  **  *  ****   **************/
/************      **  **  **  **  **    *****      ***********/
/************  **  **  **  **  **  **  *  ********  ***********/
/************      **      **      **  ***  **      ***********/
/**************************************************************/
/**************************************************************/
/**************************************************************/
//                  squint your eyes to see

//All books
Route::get('/books', [BookController::class, 'bookIndexView'])->middleware('auth');

//Search Books for book_search
Route::get('/books/search', [BookController::class, 'bookSearch'])->middleware('auth');
// //Show Create Form
// Route::get('/books/listings/create', [BookController::class, 'createView'])->middleware('auth');

// //Store new books
// Route::post('/books/listings', [BookController::class, 'saveRequest'])->middleware('auth');



//SRent book request
Route::post('/books/rent/{id}', [BookController::class, 'bookRent'])->middleware('auth');


// //Update books
// Route::put('/books/listings/{listing}', [BookController::class, 'updateRequest'])->middleware('auth');

// //Delete books
// Route::delete('/books/listings/{listing}', [BookController::class, 'deleteRequest'])->middleware('auth');

// Manage Rents
Route::get('/books/rent/return', [BookController::class, 'rentReturnView'])->middleware('auth');


// //Must to be before /books/listings/{id} route to prevent conflict
//Single books listing
Route::get('/books/{id}', [BookController::class, 'bookShowView'])->middleware('auth');


//run 
//php artisan optimize