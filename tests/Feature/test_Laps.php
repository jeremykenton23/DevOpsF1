<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LapFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_some_functionality()
    {
        // Voer de actie uit die je wilt testen
        $response = $this->post('/some-route', [
            // Stuur eventuele vereiste gegevens mee
            'data' => 'some-data',
        ]);

        // Controleer of de actie de juiste HTTP-statuscode retourneert
        $response->assertStatus(200);

        // Controleer of de juiste URL wordt verwacht na de actie
        $response->assertRedirect('/expected-url');
    }
}
