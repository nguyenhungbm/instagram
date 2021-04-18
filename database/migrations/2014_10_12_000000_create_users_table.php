<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('c_name')->nullable();
            $table->string('user')->unique();
            $table->string('avatar')->nullable();
            $table->integer('picture')->default(0);
            $table->integer('story')->default(0);
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('bio')->nullable();
            $table->integer('gender')->default(4);
            $table->integer('follower')->default(0);
            $table->string('phone')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->integer('is_active')->default(0);
            $table->integer('code_otp')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
