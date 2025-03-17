<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('flujo_vehicular', function (Blueprint $table) {
        $table->id();
        $table->foreignId('calle_id')->constrained()->onDelete('cascade');
        $table->foreignId('semaforo_id')->constrained()->onDelete('cascade');
        $table->date('fecha');
        $table->time('hora');
        $table->integer('intensidad');
        $table->foreignId('clima_id')->constrained()->onDelete('cascade');
        $table->foreignId('evento_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flujo_vehicular');
    }
};
