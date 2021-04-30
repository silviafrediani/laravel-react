<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
				'post_author' => User::inRandomOrder()->first()->id,
				'post_content' => $this->faker->text(500),
				'post_title' => $this->faker->sentence(),
				'post_excerpt' => $this->faker->text(100),
				'post_status' => 'published',
				'date_scheduled' => null,
			];
    }
}
