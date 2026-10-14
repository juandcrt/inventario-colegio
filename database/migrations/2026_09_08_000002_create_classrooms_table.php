<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->increments('id'); // INT (Adiós al BIGINT)
            
            // LLAVE FORÁNEA que conecta la sección con su grado correspondiente (INT)
            $table->unsignedInteger('grade_id');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            
            $table->string('name'); // Ej: 1A, 1B, TIC EPT
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};