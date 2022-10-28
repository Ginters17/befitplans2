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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',50);
            $table->string('description',300)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('workout_id')->constrained('workouts');
            $table->integer('reps')->nullable();
            $table->integer('sets')->nullable();
            $table->integer('duration')->nullable();
            $table->string('difficulty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
};
