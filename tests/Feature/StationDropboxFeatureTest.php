<?php

namespace Tests\Feature;

use App\Models\Dropbox;
use App\Models\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationDropboxFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Station
     *
     * @var \App\Models\Station
     */
    public $station;

    public function setUp(): void
    {
        parent::setUp();

        $this->station = Station::factory()->create();
    }

    /** @test */
    public function authorized_user_can_store_dropbox_to_station()
    {
        $this->login();

        $data = Dropbox::factory()->make()->toArray();

        $response = $this->postJson(
            route('station.dropbox.store', $this->station),
            $data
        );

        $data['station_id'] = $this->station->id;
        $response->assertCreated()->assertJson($data);
    }

    /** @test */
    public function authorized_user_can_update_dropbox_to_station()
    {
        $this->login();
        $dropbox = Dropbox::factory()->create([
            'station_id' => $this->station->id,
            'model' => Dropbox::$availableColors[0],
            'color' => Dropbox::$availableModels[0]
        ]);
        $data = [
            'model' => 'front_loading',
            'color' => 'green'
        ];

        $response = $this->putJson(
            route('station.dropbox.update', [$this->station->id, $dropbox->id]),
            $data
        );
        $response->assertOk()
            ->assertJson($data);
    }

    /** @test */
    public function user_can_delete_dropboxes_on_station()
    {
        $this->login();
        $dropbox = Dropbox::factory()->create();

        $response = $this->deleteJson(
            route('station.dropbox.destroy', [
                'station' => $dropbox->station_id,
                'dropbox' => $dropbox->id
            ])
        );

        $response->assertNoContent();
        $this->assertDeleted($dropbox);
    }
}
