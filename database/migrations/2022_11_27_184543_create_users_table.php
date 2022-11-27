<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** php artisan make:migration create_users_table
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name_');
            $table->string('surname_');
            $table->string('name_surname_');
            $table->string('username_');
            $table->string('password');            
            $table->string('age')->nullable();
            $table->text('adress')->nullable();
            $table->string('role_id');            
            $table->string('times_rented')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
        //php artisan migrate:refresh --seed
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
