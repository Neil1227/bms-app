<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->string('loan_name');
            $table->decimal('total_amount', 12, 2);
            $table->decimal('remaining_amount', 12, 2);
            $table->decimal('monthly_payment', 12, 2);

            $table->date('due_date');
            $table->date('next_payment_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
