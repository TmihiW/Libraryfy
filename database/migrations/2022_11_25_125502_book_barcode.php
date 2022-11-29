<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan make:migration book_barcode
     * @return void
     */
    public function up()
    {
        Schema::create('book_barcode', function (Blueprint $table) {
            $table->id('b_bar_id');
            $table->bigInteger('id_book');
            $table->bigInteger('barcode');
            $table->boolean('isAvailable')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_barcode');
    }
};
