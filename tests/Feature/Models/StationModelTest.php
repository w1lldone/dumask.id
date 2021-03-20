<?php

namespace Tests\Feature\Models;

use App\Models\Dropbox;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
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

    /** @test */
    public function it_has_many_dropboxes()
    {
        $station = Station::factory()
            ->has(Dropbox::factory(3))
            ->create();

        $this->assertCount(3, $station->dropboxes);
    }

    /** @test */
    public function it_can_select_and_sort_distances()
    {
        // current location. Godean Street, West Ringroad;
        $latitude = -7.777217;
        $longitude = 110.331988;

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


        // Get the nearby Station form the current location
        /** @var Collection */
        $stations = Station::withDistance($longitude, $latitude)->orderBy('distance', 'asc')->get();
        $this->assertEquals($stations->first()->id, $nearest->id);
        $this->assertEquals($stations->last()->id, $farthest->id);
    }

    /** @test */
    public function it_accepts_long_coordinates()
    {
        $latitude = -7.795727626096462;
        $longitude = 110.46538706360484;
        $station = Station::factory()->create([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        $station = $station->fresh();

        $this->assertEquals((string)$latitude, (string)$station->latitude);
        $this->assertEquals((string)$longitude, (string)$station->longitude);
    }
}
