<?php

namespace Tests\Feature;

use App\Models\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StationReportFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_submit_a_report_with_photo()
    {
        $this->login();
        $station = Station::factory()->create();

        $data = [
            'condition' => 'missing',
            'user_latitude' => $this->faker->latitude,
            'user_longitude' => $this->faker->longitude,
            'photo' => UploadedFile::fake()->image('image.jpg')
        ];
        $response = $this->postJson(route('station.report.store', $station), $data);

        $response->assertCreated();
        $this->assertNotEmpty($response->json('photo.url'));
    }

    /** @test */
    public function user_can_submit_report_without_photo()
    {
        $this->login();
        $station = Station::factory()->create();

        $data = [
            'condition' => 'missing',
            'user_latitude' => $this->faker->latitude,
            'user_longitude' => $this->faker->longitude,
            'photo' => null
        ];
        $response = $this->postJson(route('station.report.store', $station), $data);

        $response->assertCreated();
    }
}
