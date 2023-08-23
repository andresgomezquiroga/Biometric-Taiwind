<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations..
     */
    public function up(): void
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->id('id_ficha');
            $table->string('number_ficha');
            $table->date('date_start');
            $table->date('date_end');
            $table->unsignedBigInteger('programa_id')->nullable();
            $table->foreign('programa_id')->references('id_program')->on('programs');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas');
    }
};
