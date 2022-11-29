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
        Schema::create('rent', function (Blueprint $table) {
            $table->id('r_id');
            $table->unsignedBigInteger('id_user')->nullable()->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('id_book')->nullable()->references('b_id')->on('book')->constrained()->onDelete('cascade');
            $table->timestamp('rent_date');
            $table->time('return_time');
            $table->boolean('isReturn')->default(0);
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
        Schema::dropIfExists('rent');
    }
};
