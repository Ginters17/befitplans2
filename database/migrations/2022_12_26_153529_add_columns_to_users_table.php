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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('strava_api_auhtorized')->default(0);
            $table->string('access_token')->nullable();
            $table->bigInteger('access_token_expiry')->nullable();
            $table->bigInteger('refresh_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('strava_api_auhtorized')->default(0);
            $table->string('access_token')->nullable();
            $table->bigInteger('access_token_expiry')->nullable();
            $table->bigInteger('refresh_token')->nullable();
        });
    }
};
