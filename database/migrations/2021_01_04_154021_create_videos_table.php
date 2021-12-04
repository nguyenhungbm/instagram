<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
             $table->uuid('id')->primary();
            $table->integer('v_user');
            $table->string('v_content')->nullable();
            $table->string('title')->nullable();
            $table->string('v_image')->nullable();
            $table->integer('v_viewed')->default(0);
            $table->integer('v_status')->default(0);
            $table->string('v_type')->nullable();
            $table->integer('v_favourite')->default(0);
            $table->integer('v_comment')->default(0);
            $table->integer('v_share')->default(0); 
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
        Schema::dropIfExists('videos');
    }
}
