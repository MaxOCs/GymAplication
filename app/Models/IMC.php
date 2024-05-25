<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IMC extends Model
{
    use HasFactory;
    protected $table = "imc";

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }


}
