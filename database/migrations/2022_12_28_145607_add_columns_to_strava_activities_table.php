<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('strava_activities', function (Blueprint $table) {
            $table->decimal('total_elevation_gain')->nullable();
            $table->integer('moving_time')->nullable();
            $table->decimal('avg_pace')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('strava_activities', function (Blueprint $table) {
            $table->decimal('total_elevation_gain')->nullable();
            $table->integer('moving_time')->nullable();
            $table->decimal('avg_pace')->nullable();
        });
    }
};
