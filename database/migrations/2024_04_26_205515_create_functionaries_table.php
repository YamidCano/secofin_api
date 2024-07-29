<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('functionaries', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('surname');
            $table->string('document');
            $table->unsignedBigInteger('id_position')->nullable();
            $table->foreign('id_position')->references('id')->on('positions');
            $table->unsignedBigInteger('id_arl')->nullable();
            $table->foreign('id_arl')->references('id')->on('arl');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('functionaries');
    }
};
