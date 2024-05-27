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
        Schema::create('imc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarioF');
            $table->unsignedBigInteger('categoriaF')->nullable();
            $table->float('altura');
            $table->float('peso');
            $table->float('imc');
            $table->timestamps(); // Agrega las columnas created_at y updated_at
             // Definimos la clave foránea y la relación con la tabla 'usuario'
             $table->foreign('usuarioF')
             ->references('id')
             ->on('usuario')
             ->onDelete('cascade');

             $table->foreign('categoriaF')
             ->references('id')
             ->on('categorias')
             ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imc');
    }
};
