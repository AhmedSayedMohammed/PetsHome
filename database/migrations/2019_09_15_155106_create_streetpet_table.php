<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreetpetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streetpets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('telephone');
            $table->string('image')->default('default.png');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
           
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
        Schema::dropIfExists('streetpets');
    }
}
