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
            // 'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(5, 10))) . '</p>', implode() seperti join di javascript, memasukkan string pada array
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                        ->map(fn($p) => "<p>$p</p>") // menggunakan arrow function di PHP. paragraphs mengembalikan data array. collect fungsi sakti pada laravel agar bisa menggunakan map
                        ->implode(''),
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 2),
        ];
    }
}
