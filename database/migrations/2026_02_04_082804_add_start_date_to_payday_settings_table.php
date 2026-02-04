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
        Schema::table('payday_settings', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('payday_2');
        });
    }

    public function down()
    {
        Schema::table('payday_settings', function (Blueprint $table) {
            $table->dropColumn('start_date');
        });
    }
};
