<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aip_items', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_name');
            $table->string('serial_number')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('status')->default('Operativo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aip_items');
    }
};