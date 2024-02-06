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
        Schema::table('inputs', function (Blueprint $table) {
            $table->integer('image_count')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.services add_is_callservice_to_services_table
     */
    public function down(): void
    {
        Schema::table('inputs', function (Blueprint $table) {
            $table->dropColum('image_count');
        });
    }
};
