<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    //Save new listing traversymedia@gmail.com https://www.traversymedia.com/
    public function store(Request $request){
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email',Rule::unique('listings','email')],
            'tags'=>'required',
            'description'=>'required'
        ]);
        Listing::create($formFields);                
        //Session::flash('message','Listing created successfully');
        return redirect('/')->with('success','Listing created successfully');
    }
    
}
