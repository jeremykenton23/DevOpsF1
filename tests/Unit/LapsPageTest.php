<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Laps;
use App\Models\AllowedLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LapsPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function laps_page_loads_correctly()
    {
        // Create a user and login
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an AllowedLocation and Laps
        $location = AllowedLocation::factory()->create();
        $laps = Laps::factory()->count(3)->create(['location_id' => $location->id]);

        // Visit the laps page
        $response = $this->get(route('laps.index'));

        // Check if the response is OK and contains certain elements
        $response->assertStatus(200);
        $response->assertSee('Laps');

        foreach ($laps as $lap) {
            $response->assertSee($lap->lap_number);
            $response->assertSee($lap->lap_time);
        }
    }

    /** @test */
    public function can_search_laps()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $location = AllowedLocation::factory()->create();
        $lap = Laps::factory()->create(['location_id' => $location->id]);

        $response = $this->get(route('laps.index', ['search' => $lap->lap_number]));

        $response->assertSee($lap->lap_number);
    }
}
