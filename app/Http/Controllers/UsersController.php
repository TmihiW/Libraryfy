<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //Show all listings
    public function index(){
        return view('listings.index',[
            'listingsValues'=> Users::all() 
        ]);
    }
    //Show a single listing
    public function show($id){
            $listing = Users::find($id);
        if ($listing){
            return view('listings.show',[
                'listingValue'=> Users::find($id)
            ]);
        }
        else{
            abort('404');
        }
    }
}
