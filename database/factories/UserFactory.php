<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'c_name' => $this->faker->unique()->name,  
            'user' => $this->faker->userName,  
            'avatar' => 'ninja.jpg', 
            'email' => $this->faker->unique()->safeEmail, 
            'password' => Hash::make('123456'), 
            'is_active' => '1', 
        ];
    }
}
