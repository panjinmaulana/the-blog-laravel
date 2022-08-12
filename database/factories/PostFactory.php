<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)), // mt_rand(2, 8) u/ membangkitkan bilangan random 2 sampai 8
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->paragraph(mt_rand(10, 30)),
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 2),
        ];
    }
}
