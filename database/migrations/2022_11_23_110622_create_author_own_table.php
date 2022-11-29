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
        Schema::create('author_own', function (Blueprint $table) {
            $table->id('a_own_id');
            $table->unsignedBigInteger('id_author')->nullable()->references('a_id')->on('author')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('id_book')->nullable()->references('b_id')->on('book')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_own');
    }
};
