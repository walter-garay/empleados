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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salario_id');
            $table->foreign('salario_id')->references('id')->on('salarios')->onDelete('cascade');
            $table->float('monto_pagado')->nullable(); // monto_pagado puede ser null
            $table->date('fecha_pago')->nullable(); // fecha_pago puede ser null
            $table->string('metodo_pago')->nullable(); // metodo_pago puede ser null
            $table->string('periodo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
