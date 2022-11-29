<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            //if user is deleted then delete all listings with onDelete('cascade')
            $table->unsignedBigInteger('user_id')->nullable()->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('logoPath')->nullable();
            //path to logo
            //php artisan migrate:refresh --seed
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description');
            $table->timestamps();
        });

        //if make relation on DB level then you can't delete user
                // Schema::table('listings', function (Blueprint $table) {
        //     //$table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade')->change();
                        
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('listings', function (Blueprint $table) {
        //     $table->dropForeign('lists_user_id_foreign');
        //     $table->dropIndex('lists_user_id_index');
        //     $table->dropColumn('user_id');
        // });
        Schema::dropIfExists('listings');
    }
};
