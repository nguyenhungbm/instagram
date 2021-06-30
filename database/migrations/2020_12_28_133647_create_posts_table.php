<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('p_slug');
            $table->integer('p_user');
            $table->string('p_content')->nullable();
            $table->string('p_image')->nullable();
            $table->string('p_type')->nullable();
            $table->integer('p_favourite')->default(0);
            $table->integer('p_view')->default(0);
            $table->integer('p_comment')->default(0);
            $table->string('p_qrcode'); 
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
        Schema::dropIfExists('posts');
    }
}
