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
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_active')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.2024_01_20_152656_add_is_active_to_users_table
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColum('is_active');
        });
    }
};
