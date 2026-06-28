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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('subtitulo')->nullable();
            $table->string('ubicacion');
            $table->date('fecha');
            $table->enum('prioridad', ['Alta', 'Media', 'Baja'])->default('Media');
            $table->enum('estado', ['Pendiente', 'En Proceso', 'Completada'])->default('Pendiente');
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};