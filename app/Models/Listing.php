<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//create a new model with the name of the table
//php artisan make:model Listing
class Listing extends Model
{
    use HasFactory;

    //specify the table name
    protected $table = 'listings';
    //composer dump-autoload -o  //to update the autoloader

    // maybe use this for fields 
    //protected $quarded=[]; //all fields are fillable
    

    protected $fillable = [
        'title',
        'company',
        'location',
        'website',
        'email',
        'tags',
        'description'
    ];


    public function scopeFilter($query,array $filters){
        if($filters['tag'] ?? false){
        $query->where('tags','like','%'.request('tag').'%');
        //attention here | 'tag' named 'tags' in db        
        }
        if($filters['search'] ?? false){
            $query->when($filters['search'],function($query,$search){
                $query->where('title','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%')
                ->orWhere('tags','like','%'.$search.'%')
                ->orWhere('location','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%')
                ->orWhere('website','like','%'.$search.'%');
            });
            //attention here | 'tag' named 'tags' in db        
            }    
    }
}
