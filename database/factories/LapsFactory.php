<?php

namespace Database\Factories;

use App\Models\Lap;
use Illuminate\Database\Eloquent\Factories\Factory;

class LapFactory extends Factory
{
    protected $model = Lap::class;

    public function definition()
    {
        return [
            'lap_id' => $this->faker->unique()->randomNumber(),
            'lap_number' => $this->faker->numberBetween(1, 100),
            'lap_datetime' => $this->faker->dateTime,
            'lap_time' => $this->faker->time,
            'allowed_location_id' => \App\Models\AllowedLocation::factory(),
        ];
    }
}
