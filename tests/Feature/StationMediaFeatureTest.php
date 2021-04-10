<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Station;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationMediaFeatureTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function authorized_user_can_upload_station_media()
    {
        $this->login();
        Storage::fake('public');
        $station = Station::factory()->create();
        $file = UploadedFile::fake()->image('picture.jpg');

        $response = $this->postJson(route('station.media.store', $station), [
            'media' => $file
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function authorized_user_can_destroy_station_media()
    {
        $this->login();
        $station = Station::factory()->create();
        $file = UploadedFile::fake()->image('picture.jpg');

        $media = $station->addMedia($file)->toMediaCollection('images');
        $response = $this->deleteJson(route('station.media.destroy', [$station, $media]));

        $response->assertNoContent();
        $this->assertDeleted($media);
    }
}
