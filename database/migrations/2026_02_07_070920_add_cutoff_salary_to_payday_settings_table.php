<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('payday_settings', function (Blueprint $table) {

            // Salary per cutoff
            $table->decimal('salary_cutoff_1', 12, 2)
                ->nullable()
                ->after('payday_2');

            $table->decimal('salary_cutoff_2', 12, 2)
                ->nullable()
                ->after('salary_cutoff_1');

            // Active cutoff used by dashboard
            $table->enum('active_cutoff', ['1-15', '16-30'])
                ->default('1-15')
                ->after('salary_cutoff_2');
        });
    }

    public function down(): void
    {
        Schema::table('payday_settings', function (Blueprint $table) {
            $table->dropColumn([
                'salary_cutoff_1',
                'salary_cutoff_2',
                'active_cutoff',
            ]);
        });
    }
};
