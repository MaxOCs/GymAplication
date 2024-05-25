<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use HasFactory;
    protected $table = 'entrenamiento';

    public function ejercicios()
    {
        return $this->hasMany(Ejercicio::class, 'entrenamientoF');
    }
}
