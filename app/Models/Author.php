<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    //Relationship with AuthorOwn
    public function author_own(){
        return $this->hasMany(AuthorOwn::class,'id_author');
    }
}
