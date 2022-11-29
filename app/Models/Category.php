<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'c_id';

    public function scopeFilter($query,array $filters){        
        if($filters['search'] ?? false){
            $query->when($filters['search'],function($query,$search){
                $query->where('c_name_','like','%'.$search.'%');
            });       
        }    
    }
    //Relationship with BookCategory
    public function book_category(){
        return $this->hasMany(BookCategory::class,'id_category');
    }
}
