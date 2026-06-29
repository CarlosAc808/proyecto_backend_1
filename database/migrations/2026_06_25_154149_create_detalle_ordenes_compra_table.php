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
        Schema::create('detalle_ordenes_compra', function (Blueprint $table) {
            $table->id();

            $table->foreignId('orden_compra_id')
                ->constrained('ordenes_compra')
                ->onDelete('cascade');

            // Si el medicamento existe en la BD
            $table->foreignId('medicamento_id')
                ->nullable()
                ->constrained('medicamentos')
                ->nullOnDelete();

            // Si el usuario escribió un medicamento manualmente
            $table->string('medicamento_manual', 255)->nullable();

            $table->integer('unidades');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 8, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ordenes_compra');
    }
};