<?php

namespace App\Models\monitor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clima extends Model
{
    use HasFactory;
    protected $table = 'clima';

    protected $fillable = [
        'nombre',
    ];

    public function flujosVehiculares()
    {
        return $this->hasMany(FlujoVehicular::class);
    }
}
