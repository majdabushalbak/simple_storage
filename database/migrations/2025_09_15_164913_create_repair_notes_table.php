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
         Schema::create('repair_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repair_id');
            $table->text('note');
            $table->enum('status', ['pending','in-progress','completed'])->default('pending');
            $table->decimal('cost', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_notes');
    }
};
