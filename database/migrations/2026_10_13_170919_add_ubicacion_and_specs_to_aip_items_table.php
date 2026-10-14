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
    Schema::table('aip_items', function (Blueprint $table) {
        $table->string('location')->nullable()->after('equipment_name');
        $table->text('specs')->nullable()->after('model');
    });
}

public function down(): void
{
    Schema::table('aip_items', function (Blueprint $table) {
        $table->dropColumn(['location', 'specs']);
    });
}
};
