<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\monitor\Calle;
use App\Models\monitor\FlujoVehicular;
use App\Models\monitor\Semaforo;

class MonitoreadorController extends Controller
{
    public function dashboard()
    {
        return view('monitoreador.dashboard');
    }

    private function calcularTiempoPaso($tipoAutomovil, $clima, $evento)
    {
        $tiempoBase = [
            'cedan' => 2,
            'Camioneta' => 7,
            'Motocicleta' => 3,
            'Camion' => 7,
            'Taxi' => 5,
            'Motoneta' => 4,
        ];

        $tiempo = $tiempoBase[$tipoAutomovil] ?? 5;

        if ($clima === 'lluvia') {
            $tiempo += 2;
        }

        if ($evento === 'congestion') {
            $tiempo += 5;
        }

        return $tiempo;
    }

    public function flujoVehicular()
    {
        $flujos = FlujoVehicular::with(['calle', 'clima', 'evento'])->get();

        foreach ($flujos as $flujo) {
            $flujo->tiempo_paso = $this->calcularTiempoPaso(
                $flujo->tipo_automovil,
                $flujo->clima->nombre,
                $flujo->evento->nombre
            );
        }

        return view('monitoreador.flujo-vehicular', compact('flujos'));
    }

        public function calles()
        {
            $calles = Calle::with('semaforos')->get();
            $flujos = FlujoVehicular::with(['calle', 'clima', 'evento'])->get();
            return view('monitoreador.calles', compact('calles', 'flujos'));
    }

    public function actualizarTiempoSemaforo(Request $request, $id)
    {
        $request->validate([
            'tiempo_verde' => 'required|integer|min:1',
            'tiempo_amarillo' => 'required|integer|min:1',
            'tiempo_rojo' => 'required|integer|min:1',
        ]);

        $semaforo = Semaforo::findOrFail($id);
        $semaforo->update([
            'tiempo_verde' => $request->tiempo_verde,
            'tiempo_amarillo' => $request->tiempo_amarillo,
            'tiempo_rojo' => $request->tiempo_rojo,
        ]);

        // Emitir evento para actualizar en tiempo real
        event(new \App\Events\SemaforoActualizado($semaforo));

        return response()->json(['message' => 'Tiempo del semáforo actualizado correctamente.']);
    }
}