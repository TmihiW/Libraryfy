<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//create a new model with the name of the table
//php artisan make:model Listing
class Listing extends Model
{
    use HasFactory;
    
    public function scopeFilter($query,array $filters){
        if($filters['tag'] ?? false){
        $query->where('tag','like','%'.request('tag').'%');
        //attention here | 'tag' named 'tags' in db        
        }        
    }
}
