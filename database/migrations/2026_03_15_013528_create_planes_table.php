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
Schema::create('planes', function (Blueprint $table) {
    $table->id();
    $table->string('nombre', 100)->nullable();
    $table->decimal('precio', 10, 2)->nullable();
    $table->integer('duracion_dias')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};
