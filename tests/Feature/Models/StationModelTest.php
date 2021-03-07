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
}
