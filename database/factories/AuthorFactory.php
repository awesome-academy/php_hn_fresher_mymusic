<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
            'thumbnail' => 'storage/author/thumbnail/unnamed-1647600704.jpg',
            'description' => $this->faker->paragraph(),
        ];
    }
}
