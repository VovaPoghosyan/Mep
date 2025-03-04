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
        Schema::create('device_manual', function (Blueprint $table) {
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('manual_id');
            $table->timestamps();

            $table->primary(['device_id', 'manual_id']);
            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('manual_id')->references('id')->on('manuals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_manual');
    }
};
