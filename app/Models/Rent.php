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
        'rent_date',
        'return_time',
        'isReturn',
    ];

    //Relationship with user
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    //Relationship with book
    public function book(){
        return $this->belongsTo(Book::class,'id_book');
    }
    public function totalRents()
    {
        return $this::count();
    }

    //find users total rents
    public function totalUserRents($id)
    {
        return $this::where('id_user',$id)->count();
    }
}
