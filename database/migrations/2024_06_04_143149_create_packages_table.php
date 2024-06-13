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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supermarket_id');
            $table->string('tracking_number');
            $table->string('description');
            $table->float('weight');
            $table->string('dimensions');
            $table->string('status');
            $table->timestamps();

            $table->foreign('supermarket_id')->references('id')->on('supermarkets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
