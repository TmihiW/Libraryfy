<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBarcode extends Model
{
    use HasFactory;


    //Relationship with book    
    public function book(){
        return $this->belongsTo(Book::class,'id_book');
    }
    //find total book barcodes
    public function totalBookBarcodes($id)
    {
        return $this::where('id_book',$id)->count();
    }
}
