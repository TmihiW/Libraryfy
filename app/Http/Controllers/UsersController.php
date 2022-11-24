<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //Show all listings
    public function index(){
        return view('listings.user-index',[
            'listingsValues'=> Users::latest()->filter(request(['tag','search']))->get()
        ]);
    }
    //Show a single listing
    //$u_id changed in $id in database table but not in route
    public function show($u_id){
            $listing = Users::find($u_id);
        if ($listing){
            return view('listings.user-show',[
                'listingValue'=> Users::find($u_id)
            ]);
        }
        else{
            abort('404');
        }
    }
}
