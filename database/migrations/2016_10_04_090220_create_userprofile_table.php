<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->default(0);
            $table->text('avatar')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('company')->nullable();
            $table->timestamp('birthdate')->nullable();
            $table->string('email_list');
            $table->string('term_list')->nullable();
            $table->text('userdata')->nullable();
            $table->text('follow_list')->nullable();
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
        Schema::dropIfExists('userprofile');
    }
}
