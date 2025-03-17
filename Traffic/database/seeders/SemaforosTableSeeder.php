<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\monitor\Semaforo;
use App\Models\monitor\Calle;

class SemaforosTableSeeder extends Seeder
{
    public function run()
    {
        // Obtener una calle existente
        $calle = Calle::first();

        Semaforo::create([
            'calle_id' => $calle->id,
            'estado' => 'rojo',
            'tiempo_verde' => 30,
            'tiempo_amarillo' => 5,
            'tiempo_rojo' => 30,
        ]);

        Semaforo::create([
            'calle_id' => $calle->id,
            'estado' => 'verde',
            'tiempo_verde' => 40,
            'tiempo_amarillo' => 5,
            'tiempo_rojo' => 20,
        ]);
    }
}