<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_relationship', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id');
            $table->integer('tax_id');
            $table->string('object_type')->default('taxonomy');
            $table->integer('tax_order')->default(0);
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
        Schema::dropIfExists('items_relationship');
    }
}
