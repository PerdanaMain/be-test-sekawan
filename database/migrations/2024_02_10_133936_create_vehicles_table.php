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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id("vehicle_id");
            $table->integer('status_id');
            $table->integer('category_id');
            $table->integer('type_id');
            $table->integer('driver_id');
            $table->string('vehicle_name');
            $table->string('vehicle_vin');
            $table->integer('vehicle_year');
            $table->decimal('vehicle_price', 8, 2);
            $table->string('vehicle_fuel');
            $table->string('vehicle_picture');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};