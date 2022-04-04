<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "id" => $this->faker->uuid,
            "notifiable_type" => "App\Models",
            "type" => "App\Notifications",
            "data" => '',
            "read_at" => null,
        ];
    }
}
