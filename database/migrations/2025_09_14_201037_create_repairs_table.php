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
     Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('car_id')->unique(); // one row per car
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable(); // for storing the image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
