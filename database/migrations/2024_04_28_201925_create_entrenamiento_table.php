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
        Schema::create('entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->string('nivel');
            $table->string('tipo');
            $table->unsignedBigInteger('categoriaF');
            $table->timestamps();

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
        Schema::dropIfExists('entrenamiento');
    }
};
