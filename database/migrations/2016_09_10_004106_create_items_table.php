<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('craw_id')->unique();
            $table->string('author')->nullable();
            $table->integer('author_id')->default(0);
            $table->longText('description')->nullable();
            $table->string('preview')->nullable();
            $table->string('sourceurl')->nullable();
            $table->string('demourl')->nullable();
            $table->string('documentation')->nullable();
            $table->string('uploaded')->nullable();
            $table->string('highsolution')->default('N/A');
            $table->string('widgetready')->default('N/A');
            $table->number('sales')->default(0);
            $table->number('price')->default(0);
            $table->string('thumbs')->nullable();
            $table->text('tags')->nullable();
            $table->text('fonts')->nullable();
            $table->text('cat_tree')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('items');
    }
}
