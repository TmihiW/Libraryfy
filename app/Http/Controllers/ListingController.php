<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listings
    public function indexView(){
        //dd(request('tag'));
        //dd(Listing::latest()->filter(request(['tag','search']))->paginate('4'));
        return view('listings.index',[
            'listingsValues'=> Listing::latest()->filter(request(['tag','search']))->paginate('4')
        ]);
        //  it gives page 2 =>    /?page=2
    }
    //Show a single listing
    public function showView($id){
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
    public function createView(){
        return view('listings.create');
    }

    //Save new listing traversymedia@gmail.com https://www.traversymedia.com/
    public function saveRequest(Request $request){
        //dd($request->file('logo'));
        //dd($request->file('logo')->store('logos','public'));
        // or 
        //dd($request->file('logo')->store('public'));
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email',Rule::unique('listings','email')],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logoPath']=$request->file('logo')->store('logos','public');
        }
        Listing::create($formFields);                
        //Session::flash('message','Listing created successfully');
        return redirect('/')->with('success','Listing created successfully');
    }
    
}
