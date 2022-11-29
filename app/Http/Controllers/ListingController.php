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
            'listingsValues'=> Listing::latest()->filter(request(['tag','search']))->paginate('4',['*'],'listings')
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

    //Save new listing to database
    public function saveRequest(Request $request){
        //dd($request->file('logo'));
        //dd($request->file('logo')->store('logos','public'));
        // or 
        //dd($request->file('logo')->store('public'));
        $formFields=$request->validate([
            'title'=>['required','string','max:255'],
            'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>['required','string','max:255'],
            'email'=>['required','email',Rule::unique('listings','email')],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logoPath']=$request->file('logo')->store('logos','public');
        }
        $formFields['user_id']=auth()->user()->id;
        Listing::create($formFields);                
        //Session::flash('message','Listing created successfully');
        return redirect('/laragigs/')->with('success','Listing created successfully');
    }
    //Show form to edit listing
    public function editView(Listing $listing){ 
        //dd($listing);       
        if ($listing){
            return view('listings.edit',[
                'listingGonaEdited'=> $listing
            ]);
        }
        else{
            abort('404');
        }
    }
    public function updateRequest(Request $request, Listing $listing){
        
        //Make sure that the user is the owner of the listing
        if( auth()->user()->role_id!=1){ //except admin
            if($listing->user_id != auth()->user()->id){
                return redirect('/laragigs/')->with('success','Unauthorized Page');
            }
        }
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logoPath']=$request->file('logo')->store('logos','public');
        }
        $listing->update($formFields);                
        //Session::flash('message','Listing created successfully');
        return redirect('/laragigs/listings/'.$listing->id)->with('success','Listing updated successfully');
    }
    public function deleteRequest(Listing $listing){
        //Make sure that the user is the owner of the listing
        if( auth()->user()->role_id!=1){ //except admin
            if($listing->user_id != auth()->user()->id){
                return redirect('/laragigs/')->with('success','Unauthorized Page');
            }
        }
        $listing->delete();
        return redirect('/laragigs/')->with('success','Listing deleted successfully');
    }

    //manage  Listings
    public function manageView(){
        return view('listings.manage',[
            'listingsGonaManaged'=> auth()->user()->listings()->get()
        ]);
    }
    
}
