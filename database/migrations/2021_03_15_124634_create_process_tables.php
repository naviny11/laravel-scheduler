<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('random', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value',20);
            $table->dateTime('created_tms', $precision = 0);
        });

        Schema::create('process_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('start_time', $precision = 0);
            $table->dateTime('end_time', $precision = 0)->nullable();
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('random');
        Schema::dropIfExists('process_status');
    }
}
