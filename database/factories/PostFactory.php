<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [ 
        'p_user' => $this->faker->randomDigit,
        'p_image' =>'images.jpg',
        'p_slug'=>Str::random(15),
        'p_content' =>$this->faker->realText($maxNbChars = 100, $indexSize = 2),
        'p_type' => 'profile',  
        'p_qrcode' => '',  
        'created_at'=>now(),
        'updated_at'=>now(),
        ];
    }
}
