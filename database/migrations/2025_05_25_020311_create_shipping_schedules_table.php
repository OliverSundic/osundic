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
        Schema::create('shipping_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')->constrained();
            $table->foreignId('departure_port_id')->constrained('ports');
            $table->foreignId('arrival_port_id')->constrained('ports');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_schedules');
    }
};
