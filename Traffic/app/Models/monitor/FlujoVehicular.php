<?php

namespace App\Models\monitor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlujoVehicular extends Model
{
    use HasFactory;
    protected $table = 'flujo_vehicular';

    protected $fillable = [
        'calle_id',
        'semaforo_id',
        'fecha',
        'hora',
        'intensidad',
        'clima_id',
        'evento_id',
        'clasificacion_conducta_id',
        'tipo_automovil',
        'tiempo_paso',
    ];

    public function calle()
    {
        return $this->belongsTo(Calle::class);
    }

    public function semaforo()
    {
        return $this->belongsTo(Semaforo::class);
    }

    public function clima()
    {
        return $this->belongsTo(Clima::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function clasificacionConducta()
    {
        return $this->belongsTo(ClasificacionConducta::class);
    }

    public function tipoAutomovil()
{
    return $this->belongsTo(TipoAutomovil::class, 'tipo_automovil_id');
}
}
