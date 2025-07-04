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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable(); // dni puede ser null
            $table->string('nombre');
            $table->date('fecha_ingreso');
            $table->string('tipo'); // tipo no puede ser null
            $table->decimal('salario_mensual', 10, 2)->nullable();
            $table->decimal('tarifa_contrato', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
