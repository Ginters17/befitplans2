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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',100);
            $table->string('description',300)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');;
            $table->integer('day');
            $table->string('difficulty')->nullable();
            $table->boolean('day_off');
            $table->boolean('is_complete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workouts');
    }
};
