<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.2024_01_28_134218_add_image_count_to_inputs_table
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->text('desc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColum('desc');
        });
    }
};
