<?php
namespace App\Models;

class Listing{
    public static function all(){
        return 
        [
            [
            'id'=>1,
            'title'=>'Listing One',
            'description'=>'This is my first listing'
            ],
            [
            'id'=>2,
            'title'=>'Listing Two',
            'description'=>'This is my second listing'
            ]
        ];
    }
    //find by id
    public static function find($id){
        //use self when you have a class and you want to call a static method or property in a static function
        $listings=self::all();
        foreach($listings as $listing){
            if($listing['id']==$id){
                return $listing;
            }
        }
    }
}