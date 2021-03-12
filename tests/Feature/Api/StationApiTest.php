<?php

namespace Tests\Feature\Api;

use App\Models\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_get_stations()
    {
        Station::factory(20)->hasDropboxes(2)->create();

        $response = $this->get(route('api.stations.index'));

        $response->assertOk()->assertJsonCount(15, 'data');
    }
}
