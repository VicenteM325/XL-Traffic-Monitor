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
        Schema::table('flujo_vehicular', function (Blueprint $table) {
            $table->string('tipo_automovil')->nullable(); // Tipo de automóvil (por ejemplo, "sedan", "camioneta", "motocicleta")
            $table->integer('tiempo_paso')->nullable(); // Tiempo que tarda en pasar (en segundos)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flujo_vehicular', function (Blueprint $table) {
            $table->dropColumn('tipo_automovil');
            $table->dropColumn('tiempo_paso');
        });
    }
};
