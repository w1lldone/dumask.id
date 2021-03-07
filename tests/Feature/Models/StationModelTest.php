<?php

namespace Tests\Feature\Models;

use App\Models\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function stations_can_be_created_using_factory()
    {
        $stations = Station::factory()->count(5)->create();

        $this->assertDatabaseCount('stations', 5);
    }

    public function it_can_select_distances()
    {
        $farthest = Station::factory()->create([
            'name' => 'Plaza Ambarukmo',
            'latitude' => -7.782721,
            'longitude' => 110.401181,
        ]);

        $middle = Station::factory()->create([
            'name' => 'kantor pusat',
            'latitude' => -7.767970,
            'longitude' => 110.378565,
        ]);

        $nearest = Station::factory()->create([
            'name' => 'RS Sardjito',
            'latitude' => -7.768735,
            'longitude' => 110.373372,
        ]);

        $latitude = -7.777217;
        $longitude = 110.331988;
        $stations = Station::withDistance($longitude, $latitude)->orderBy('distance', 'asc')->get();
        $this->assertEquals($stations->first()->id, $nearest->id);
    }
}
