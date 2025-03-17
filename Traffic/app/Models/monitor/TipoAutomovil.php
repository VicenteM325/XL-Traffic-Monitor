<?php

namespace App\Models\monitor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAutomovil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tiempo_paso',
    ];
}
