<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// php artisan make:controller UserController

class UserController extends Controller
{
    //Show all listings
    public function userIndexView(){
        return view('listings.user-index',[
            'listingsValues'=> User::latest()->filter(request(['tag','search']))->get()
        ]);
    }
    //Show a single listing
    //$u_id changed in $id in database table but not in route
    public function userShowView($u_id){
            $listing = User::find($u_id);
        if ($listing){
            return view('listings.user-show',[
                'listingValue'=> User::find($u_id)
            ]);
        }
        else{
            abort('404');
        }
    }
    
    public function registerView(){
        return view('users.register');
    }
    //Create new user for listing
    public function saveRegisterRequest(Request $request){
        $formUser = $request->validate([
            'name_' => ['required', 'min:3', 'max:255'],
            'surname_' => ['required', 'min:3', 'max:255'],
            'age' => ['required', 'min:1', 'max:3'],
            'adress' => ['required', 'min:3'],
            'username_' => ['required', 'min:3', 'max:255'],
            'email' => ['required','email',Rule::unique('users','email'),'max:255'],
            'password' => 'required|confirmed|min:6|max:255',
        ]);       

        //Hash password
        $formUser['password'] = bcrypt($formUser['password']);
        
        //Create user
        $formUser['name_surname_'] = $formUser['name_'] . ' ' . $formUser['surname_'];
        $formUser['role_id'] = 0;      //role id 1 is admin
        $formUser['times_rented'] = 0;
        $formUser['remember_token'] = Str::random(10);
        
        $user=User::create($formUser);
        
        //Login user
        auth()->login($user);
        
        //Redirect to home page
        return redirect('/')->with('success','User created successfully and logged in');
    }
    
    //logout user
    public function logoutRequest(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success','User logged out');
    }

    //Show login form
    public function loginView(){
        return view('users.login');
    }

    //Login user
    public function authenticateRequest(Request $request){
        $formUser = $request->validate([
            'email' => ['required','email','max:255'],
            'password' => 'required|min:6|max:255',
        ]);       

        if(auth()->attempt($formUser)){
            $request->session()->regenerate();
            return redirect('/')->with('success','You are now logged in');
        }
        
        return back()->withErrors(['email'=>'Invalid email or password'])->onlyInput('email');
            
        
    }

    //it saves lifes php artisan optimize
}
