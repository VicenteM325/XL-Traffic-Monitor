<?php

namespace App\Models\monitor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function calles()
    {
        return $this->hasMany(Calle::class);
    }
    
}
