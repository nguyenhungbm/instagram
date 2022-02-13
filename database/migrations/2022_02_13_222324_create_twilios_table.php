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
        Schema::create('twilio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author')->nullable();
            $table->string('friend')->nullable();
            $table->string('token');
            $table->text('body')->nullable();
            $table->string('type')->nullable();
            $table->integer('repeats')->default(0); 
            $table->string('channelSid')->nullable();
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
