<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_log', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->string('duration');
            $table->string('ip');
            $table->string('url');
            $table->string('method');
            $table->string('input');
            $table->string('files');
            $table->longText('output');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_log');
    }
}
