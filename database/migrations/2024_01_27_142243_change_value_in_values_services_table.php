<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.change_desc_in_services_table
     */
    public function up(): void
    {
        Schema::table('values_services', function (Blueprint $table) {
            $table->text('value')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('values_services', function (Blueprint $table) {
            $table->dropColum('value');
        });
    }
};
