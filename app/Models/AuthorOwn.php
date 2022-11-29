<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorOwn extends Model
{
    use HasFactory;
    //Relationship with author
    public function author(){
        return $this->belongsTo(Author::class,'id_author');
    }
}
