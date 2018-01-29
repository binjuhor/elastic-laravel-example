<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('board_id')->unique();
            $table->text('item_id');
            $table->text('chart_data');
            $table->text('chart_setting');
            $table->text('table_data');
            $table->text('table_setting');
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
        Schema::dropIfExists('board_data');
    }
}
