<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //Show all listings
    public function index(){
        //dd(request('tag'));
        return view('listings.index',[
            'listingsValues'=> Listing::latest()->filter(request(['tag','search']))->get()
        ]);
    }
    //Show a single listing
    public function show($id){
            $listing = Listing::find($id);
        if ($listing){
            return view('listings.show',[
                'listingValue'=> Listing::find($id)
            ]);
        }
        else{
            abort('404');
        }
    }
    //Show form to create new listing
    public function create(){
        return view('listings.create');
    }
}
