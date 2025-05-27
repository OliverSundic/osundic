<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In the migration file
    public function up()
    {
        Schema::table('ships', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('capacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ships', function (Blueprint $table) {
            //
        });
    }
};
