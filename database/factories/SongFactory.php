<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'thumbnail' => 'storage/song/thumbnail/ai-no-1647600744.jpg',
            'path' => 'storage/song/source/ainoremix2-masewkhoivu-7107607-1647929024.mp3',
            'description' => $this->faker->paragraph(),
            'album_id' => NULL,
            'durations' => $this->faker->randomNumber(3, true),
        ];
    }
}
