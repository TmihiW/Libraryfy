<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorOwn extends Model
{
    use HasFactory;
    protected $table = 'author_own';
    protected $primaryKey = 'a_own_id';

    //Relationship with author
    public function author(){
        return $this->belongsTo(Author::class,'id_author');
    }
    //Relationship with book
    public function book(){
        return $this->belongsTo(Book::class,'id_book');
    }

    //find total author owns
    public function totalAuthorOwns($id)
    {
        return $this::where('id_author',$id)->count();
    }
}
