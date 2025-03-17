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
        Schema::create('semaforos', function (Blueprint $table) {
            $table->id(); // ID único del semáforo
            $table->foreignId('calle_id')->constrained()->onDelete('cascade'); 
            $table->string('estado')->default('rojo'); 
            $table->integer('tiempo_verde')->default(30); 
            $table->integer('tiempo_amarillo')->default(5); 
            $table->integer('tiempo_rojo')->default(30); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semaforos');
    }
};
