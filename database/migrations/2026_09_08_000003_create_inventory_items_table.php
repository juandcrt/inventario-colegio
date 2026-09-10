<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            // LLAVE FORÁNEA que conecta el mueble con el aula específica
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            $table->string('objeto'); // Mesas, Sillas, Ventanas, etc.
            $table->integer('cantidad');
            $table->string('condicion'); // Bueno, Regular, Malo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};