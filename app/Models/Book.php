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
    
    //book_barcode id_book    
    public function book_barcode(){
        return $this->hasMany(BookBarcode::class,'id_book');
    }
    // rent id_book
    public function rent(){
        return $this->hasMany(Rent::class,'id_book');
    }
}
