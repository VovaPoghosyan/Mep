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
        Schema::create('engineering_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->string('company')->nullable();
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->text('notes');
            $table->string('report_error')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('technician_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engineering_notes');
    }
};
