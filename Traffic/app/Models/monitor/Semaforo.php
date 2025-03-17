<?php

namespace App\Models\monitor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semaforo extends Model
{
    use HasFactory;

    protected $fillable = [
        'calle_id',
        'estado',
        'tiempo_verde',
        'tiempo_amarillo',
        'tiempo_rojo',
    ];

    public function calle()
    {
        return $this->belongsTo(Calle::class);
    }

    public function flujosVehiculares()
    {
        return $this->hasMany(FlujoVehicular::class);
    }
}
