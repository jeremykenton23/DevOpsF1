<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Lap;
use Carbon\Carbon;

class LapFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_lap_successfully()
    {
        $lapData = [
            'location_id' => 1,
            'lap_datetime' => Carbon::parse('2024-05-24 11:22:32'),
            'lap_time' => '00:01,23',
            'lap_number' => 1,
        ];

        // Simulate creating a lap
        $response = $this->post('/laps', $lapData);

        // Check if the lap was successfully created
        $response->assertStatus(302); // Check if the status code indicates a redirect

        // Check if the lap is actually stored in the database
        $this->assertDatabaseHas('laps', $lapData);
    }
}
