<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use  HasFactory,HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name_',
        'surname_',
        'age',
        'adress',
        'username_',        
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function scopeFilter($query,array $filters){        
        if($filters['search'] ?? false){
            $query->when($filters['search'],function($query,$search){
                $query->where('name_','like','%'.$search.'%')
                ->orWhere('surname_','like','%'.$search.'%')
                ->orWhere('name_surname_','like','%'.$search.'%')
                ->orWhere('username_','like','%'.$search.'%')
                ->orWhere('adress','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%');
            });       
        }    
    }

    //Relationship With Listing
    public function listings(){
        return $this->hasMany(Listing::class,'user_id');
    }


    //   php artisan tinker
    //   \App\Models\User::first()
    //   \App\Models\Listing::first()
    //   \App\Models\Listing::find(7)
    //   \App\Models\Listing::find(7)->user
    //   \App\Models\Listing::find(7)->user->name_
    //   \App\Models\Listing::find(7)->user->listings
    //   \App\Models\Listing::find(7)->user->listings->first()

    
    //   php artisan tinker
    //   $user = App\Models\User::find(6);
    //   $user->listings;
    //   $user->listings->first();

    //   exit
}
