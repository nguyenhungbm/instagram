<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwiliosTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twilios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author')->unsigned();
            $table->integer('friend')->unsigned();
            $table->string('token');
            $table->text('body')->nullable();
            $table->string('type')->nullable();
            $table->integer('repeats')->default(0); 
            $table->string('channelSid')->default(0);
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
        Schema::dropIfExists('twilio');
    }
}
