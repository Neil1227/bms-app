<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
        ALTER TABLE payday_settings
        MODIFY frequency ENUM('monthly','semi_monthly','bi_weekly')
    ");
    }

    public function down()
    {
        DB::statement("
        ALTER TABLE payday_settings
        MODIFY frequency ENUM('monthly','semi_monthly')
    ");
    }
};
