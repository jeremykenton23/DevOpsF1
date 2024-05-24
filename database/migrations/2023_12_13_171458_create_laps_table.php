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
        Schema::create('laps', function (Blueprint $table) {
            $table->id('lap_id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('location_id'); // Foreign key to allowed_locations table
            $table->foreign('location_id')->references('id')->on('allowed_locations');
            $table->datetime('lap_datetime');
            $table->string('lap_time');
            $table->unsignedInteger('lap_number');
            $table->boolean('validated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laps');
    }
};
