<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_tree', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_tree');
            $table->string('id_list');
            $table->integer('cat_id');
            $table->integer('items');
            $table->integer('total_sale')->default(0);
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
