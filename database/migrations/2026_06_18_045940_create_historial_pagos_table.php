<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
                ->constrained('usuarios') // Asegúrate de que apunte a 'usuarios' si ese es el nombre de tu tabla
                ->onDelete('cascade');

            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');
            $table->string('metodo_pago')->nullable();
            $table->string('estado'); // pagado, pendiente, cancelado

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_pagos');
    }
};