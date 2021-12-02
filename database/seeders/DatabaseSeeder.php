<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Admin::factory(100)->create();
        \App\Models\User::factory(100)->create();
        // \App\Models\Post::factory(100)->create();
        // \App\Models\Like::factory(100)->create();
        // \App\Models\Follow::factory(100)->create();
    }
}
