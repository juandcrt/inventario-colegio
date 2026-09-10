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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('classroom_section'); // Ej: Aula 101 - 3ro B
            $table->string('item_type'); // Ej: Silla, Carpeta, Ventana
            $table->integer('quantity'); // Cantidad contada
            $table->enum('condition', ['Bueno', 'Regular', 'Malo']); // Estado físico
            $table->text('observations')->nullable(); // Notas o detalles adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};