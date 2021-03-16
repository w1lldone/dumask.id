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

    /** @test */
    public function user_can_get_nearby_stations()
    {
        Station::factory()->create([
            'name' => 'Kampus Pusat UNS Kentingan, Surakarta',
            'latitude' => -7.5589554,
            'longitude' => 110.8561915,
        ]);

        Station::factory()->create([
            'name' => 'Plaza Ambarukmo',
            'latitude' => -7.782721,
            'longitude' => 110.401181,
        ]);
        
        $longitude = "110.378565";
        $latitude = "-7.767970";

        $response = $this->get(route('api.stations.index', [
            'longitude' => $longitude,
            'latitude' => $latitude
        ]), [
            'Accept' => 'application/json'
        ]);

        $response->dump()->assertOk()->assertJsonCount(1, 'data');

    }
}
