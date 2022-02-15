<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBingoLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bingo_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bingo_id')->unsigned();
            $table->integer('number');
            $table->timestamps();

            $table->foreign('bingo_id')->references('id')->on('bingo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bingo_logs');
    }
}
