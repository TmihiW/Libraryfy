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
        'b_name',
        'page',
        'price',
    ];
    
    //Relationship with book barcode 
    public function book_barcode(){
        return $this->hasMany(BookBarcode::class,'id_book');
    }
    //Relationship with rent
    public function rent(){
        return $this->hasMany(Rent::class,'id_book');
    }
}
