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
        Schema::create('payday_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('frequency', ['monthly', 'semi_monthly'])->default('monthly');
            $table->unsignedTinyInteger('payday_1');
            $table->unsignedTinyInteger('payday_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payday_settings');
    }
};
