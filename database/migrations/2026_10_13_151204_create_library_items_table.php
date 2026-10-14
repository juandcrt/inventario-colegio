<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('isbn')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('status')->default('Bueno');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_items');
    }
};