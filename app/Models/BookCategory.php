<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    //Relationship with Category
    public function category(){
        return $this->belongsTo(Category::class,'id_category');
    }
    //Relationship with Book
    public function book(){
        return $this->belongsTo(Book::class,'id_book');
    }
}
