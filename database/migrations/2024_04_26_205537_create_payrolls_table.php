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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_employee')->nullable();
            $table->foreign('id_employee')->references('id')->on('employees');
            $table->unsignedBigInteger('id_position')->nullable();
            $table->foreign('id_position')->references('id')->on('positions');
            $table->integer('risk')->nullable();
            $table->string('salary')->nullable();
            $table->string('worked_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
