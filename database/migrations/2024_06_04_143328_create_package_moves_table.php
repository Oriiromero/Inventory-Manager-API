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
        Schema::create('package_moves', function (Blueprint $table) {
            $table->id();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->string('status');
            $table->string('location');
            $table->foreign('handled_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_moves');
    }
};
