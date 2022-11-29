<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'book';
    protected $primaryKey = 'b_id';
    protected $fillable = [
        'b_name_',
        'page',
        'price',
    ];
                // multi column tab index
                // <div class="control-group">
                //     <label class="control-label" for="basicinput">Category</label>
                //     <div class="controls">
                //         <select tabindex="1" id="category" data-form-field="category" data-placeholder="Select category.." class="span8">
                //             @foreach($categories_list as $category)
                //                 <option value="{{ $category->id }}">{{ $category->category }}</option>
                //             @endforeach
                //         </select>
                //     </div>
                // </div>
    public function scopeFilter($query,array $filters){        
        if($filters['search'] ?? false){
            $query->when($filters['search'],function($query,$search){
                $query->where('b_name_','like','%'.$search.'%')
                ->orWhere('price','like','%'.$search.'%');
            });       
        }    
    }

    //Relationship with book barcode 
    public function book_barcode(){
        return $this->hasMany(BookBarcode::class,'id_book');
    }
    //Relationship with rent
    public function rent(){
        return $this->hasMany(Rent::class,'id_book');
    }
    //Relationship with book category
    public function book_category(){
        return $this->hasOne(BookCategory::class,'id_book');
    }
    //Relationship with book AuthorOwn
    public function book_author_own(){
        return $this->hasOne(BookAuthorOwn::class,'id_book');
    }
}
