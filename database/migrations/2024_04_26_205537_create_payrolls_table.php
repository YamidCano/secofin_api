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
            $table->unsignedBigInteger('id_functionary')->nullable();
            $table->foreign('id_functionary')->references('id')->on('functionaries');
            $table->unsignedBigInteger('id_position')->nullable();
            $table->foreign('id_position')->references('id')->on('positions');
            $table->integer('risk')->nullable();
            $table->string('salary')->nullable();
            $table->string('worked_days')->nullable();
            //$table->string('incapacidad')->nullable(); datos ingresados no calculados
            //$table->string('licencia no remunerada')->nullable(); datos ingresados no calculados
            //$table->string('vacaciones')->nullable(); datos ingresados no calculados
            //$table->string('otras novedades')->nullable(); datos ingresados no calculados
            //$table->string('Client')->nullable(); datos ingresados no calculados
            //$table->string('type_payroll')->nullable(); datos ingresados no calculados
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
