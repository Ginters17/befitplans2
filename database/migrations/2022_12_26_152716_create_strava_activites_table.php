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
        Schema::create('strava_activities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('exercise_id')->nullable()->constrained('exercises');
            $table->bigInteger('activity_id')->unique();
            $table->string('name');
            $table->string('distance');
            $table->string('elapsed_time');
            $table->string('type');
            $table->string('start_date_local');
            $table->string('start_date_local_short');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strava_activites');
    }
};
