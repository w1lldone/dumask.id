<?php

namespace Tests\Feature;

use App\Models\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorized_user_can_visit_station_index_page()
    {
        $this->login();
        Station::factory(15)->hasDropboxes(2)->create();

        $response = $this->get(route('station.index'));

        $response->assertOk();
    }

    /** @test */
    public function authorized_user_can_visit_station_show_page()
    {
        $this->login();
        $station = Station::factory()->hasDropboxes(2)->create();

        $response = $this->getJson(route('station.show', $station));

        $response->assertOk();
    }

    /** @test */
    public function authorized_user_can_store_a_station()
    {
        $this->login();
        $data = Station::factory()->make()->toArray();

        $response = $this->postJson(route('station.store'), $data);

        $response->assertCreated()->assertJson($data);
    }

    /** @test */
    public function authorized_user_can_update_station()
    {
        $this->login();
        $station = Station::factory()->hasDropboxes(2)->create();
        $data = Station::factory()->make()->toArray();

        $response = $this->putJson(route('station.update', $station), $data);
        $data['id'] = $station->id;

        $response->assertOk()
            ->assertJson($data);
    }

    /** @test */
    public function authorized_user_can_delete_station()
    {
        $this->login();
        $station = Station::factory()->hasDropboxes(2)->create();

        $response = $this->deleteJson(route('station.destroy', $station));

        $response->assertNoContent();
        $this->assertDeleted($station);
    }
}
