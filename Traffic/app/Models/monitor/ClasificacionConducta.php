<?php

namespace App\Models\monitor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasificacionConducta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function flujosVehiculares()
    {
        return $this->hasMany(FlujoVehicular::class);
    }
}
