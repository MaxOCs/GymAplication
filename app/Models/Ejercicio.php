<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;

    protected $table = "ejercicios";

    public function entrenamiento()
    {
        return $this->belongsTo(Entrenamiento::class, 'id');
    }
}
