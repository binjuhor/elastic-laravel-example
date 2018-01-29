<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idtree');
            $table->integer('salesdate');
            $table->integer('sales');
            $table->integer('items');
            $table->integer('saleweek');
            $table->integer('salemonth');
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
        Schema::dropIfExists('catinfo');
    }
}
