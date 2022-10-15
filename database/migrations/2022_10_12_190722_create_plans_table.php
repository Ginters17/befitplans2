<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',50);
            $table->string('description',300)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('category_id')->nullable()->constrained('category');
            $table->integer('age_max')->nullable();
            $table->integer('age_min')->nullable();
            $table->integer('sex')->nullable(); 
            $table->boolean('is_default'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('plans');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
