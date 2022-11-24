<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
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
}
