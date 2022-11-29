<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table='author';
    protected $primaryKey='a_id';

    protected $fillable = [
        'name_',
        'surname_',
        'birth_dt',
        'death_dt',
        'age',
    ];
    public function scopeFilter($query,array $filters){        
        if($filters['search'] ?? false){
            $query->when($filters['search'],function($query,$search){
                $query->where('name_','like','%'.$search.'%')
                ->orWhere('surname_','like','%'.$search.'%')
                ->orWhere('name_surname_','like','%'.$search.'%');
            });       
        }    
    }

    //Relationship with AuthorOwn
    public function author_own(){
        return $this->hasMany(AuthorOwn::class,'id_author');
    }
}
