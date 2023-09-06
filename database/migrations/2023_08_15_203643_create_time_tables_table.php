<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.,,,
     */
    public function up(): void
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id('id_timeTable');
            $table->enum('jornada', ['Manana', 'Mixta', 'Noche']);
            $table->time('time_start');
            $table->time('time_end');
            $table->date('date_start');
            $table->date('date_end');
            $table->unsignedBigInteger('ficha_id')->nullable();
            $table->foreign('ficha_id')->references('id_ficha')->on('fichas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tables');
    }
};
