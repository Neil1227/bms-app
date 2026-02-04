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
            $table->integer('payday_1')->nullable()->change();
            $table->integer('payday_2')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('payday_settings', function (Blueprint $table) {
            $table->integer('payday_1')->nullable(false)->change();
        });
    }
};
