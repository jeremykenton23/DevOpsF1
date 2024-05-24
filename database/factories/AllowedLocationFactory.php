<?php

namespace Database\Factories;

use App\Models\AllowedLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllowedLocationFactory extends Factory
{
    protected $model = AllowedLocation::class;

    public function definition()
    {
        return [
            'location' => $this->faker->city, // Generate a random city name as the location
        ];
    }
}
