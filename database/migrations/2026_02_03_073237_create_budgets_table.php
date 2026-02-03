<?php
// database/migrations/xxxx_xx_xx_create_budgets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            // optional: if user-based later
            // $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('color')->default('gray');

            $table->string('frequency'); // Monthly, Weekly, One-time
            $table->date('date')->nullable();

            $table->decimal('amount', 10, 2);

            $table->enum('cutoff', ['1-15', '16-30']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
