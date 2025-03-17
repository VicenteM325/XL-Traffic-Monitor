<?php

namespace App\Models\monitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Calle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_via_id',
    ];

    public function tipoVia()
    {
        return $this->belongsTo(TipoVia::class);
    }

    public function semaforos()
    {
        return $this->hasMany(Semaforo::class);
    }

    public function flujosVehiculares()
    {
        return $this->hasMany(FlujoVehicular::class);
    }
}
