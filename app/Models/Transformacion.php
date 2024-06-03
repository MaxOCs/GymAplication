<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transformacion extends Model
{
    use HasFactory;
    protected $table = "transformacion";

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
