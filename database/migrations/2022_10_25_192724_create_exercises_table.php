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
            $table->string('name',100);
            $table->string('description',1000)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('workout_id')->constrained('workouts')->onDelete('cascade');;
            $table->integer('reps')->nullable();
            $table->integer('sets')->nullable();
            $table->integer('duration')->nullable();
            $table->string('difficulty')->nullable();
            $table->string('is_complete')->nullable();
            $table->integer('duration_type')->nullable();
            $table->string('info_video_url')->nullable();
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
