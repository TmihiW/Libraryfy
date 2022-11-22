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
}