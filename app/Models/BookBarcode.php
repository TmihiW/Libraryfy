<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBarcode extends Model
{
    use HasFactory;

    
    //book id_book    
    public function book(){
        return $this->belongsTo(User::class,'id_book');
    }
}
