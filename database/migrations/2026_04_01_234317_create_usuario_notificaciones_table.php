<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario_notificaciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuario_id')
                ->constrained('usuarios')
                ->cascadeOnDelete();

            $table->foreignId('notificacion_id')
                ->constrained('notificaciones')
                ->cascadeOnDelete();

            $table->boolean('habilitado')->default(true);
            $table->string('canal', 50)->nullable();

            $table->timestamps();

            $table->unique(['usuario_id', 'notificacion_id'], 'unique_usuario_notificacion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_notificaciones');
    }
};