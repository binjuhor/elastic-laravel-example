<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemweeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemweeks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->default(0);
            $table->string('craw_id')->nullable();
            $table->string('title')->nullable();
            $table->float('price')->default(0);
            $table->integer('sales')->default(0);
            $table->integer('salesweek')->default(0);
            $table->integer('week')->default(0);
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
        Schema::dropIfExists('itemweeks');
    }
}
