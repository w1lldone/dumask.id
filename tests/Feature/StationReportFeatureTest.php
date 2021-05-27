<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
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

    /** @test */
    public function user_can_resolve_all_reports()
    {
        $this->login();
        $station = Station::factory()->create();
        /** @var Collection */
        $reports = Report::factory(5)->create([
            'station_id' => $station->id
        ]);

        $response = $this->putJson(
            route('station.report.resolve', $station),
            [
                'resolve_all' => true,
            ]
        );

        $response->assertOk();
        $this->assertDatabaseMissing('reports', [
            'resolver_id' => null,
            'resolved_at' => null,
        ]);
    }

    /** @test */
    public function user_can_resolve_report_using_id()
    {
        $this->login();
        $station = Station::factory()->create();
        /** @var Collection */
        $resolved = Report::factory(2)->create([
            'station_id' => $station->id
        ]);
        $unresolved = Report::factory(3)->create([
            'station_id' => $station->id
        ]);

        $response = $this->putJson(
            route('station.report.resolve', $station),
            [
                'report_id' => $resolved->pluck('id'),
            ]
        );

        $response->assertOk();
        $this->assertEquals(2, Report::whereNotNull('resolved_at')->count());
        $this->assertEquals(3, Report::whereNull('resolved_at')->count());
    }
}
