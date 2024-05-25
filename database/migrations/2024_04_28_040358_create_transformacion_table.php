<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transformacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarioF');
            $table->unsignedBigInteger('categoriaF');
            $table->timestamps();
              // Definimos la clave foránea y la relación con la tabla 'usuario'
              $table->foreign('usuarioF')
              ->references('id')
              ->on('usuario')
              ->onDelete('cascade'); // Esto elimina registros de IMC si el usuario se elimina

              $table->foreign('categoriaF')
              ->references('id')
              ->on('categorias')
              ->onDelete('cascade'); // Esto elimina registros de IMC si el usuario se elimina
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transformacion');
    }
};
