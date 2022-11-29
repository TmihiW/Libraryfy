<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $table = 'rent';
    protected $primaryKey = 'r_id';    
    protected $fillable = [
        'id_user',
        'id_book',
        'date_rent',
        'date_return',
        'isReturn',
    ];

    //user id_user
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    //book id_book
    public function book(){
        return $this->belongsTo(Book::class,'id_book');
    }
}
