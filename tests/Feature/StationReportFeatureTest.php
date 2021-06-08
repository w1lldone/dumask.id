<?php

namespace Tests\Feature;

use App\Jobs\SendReportNotification;
use App\Models\Report;
use App\Models\Station;
use App\Models\User;
use App\Notifications\ReportSubmittedNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class StationReportFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_submit_a_report_with_photo()
    {
        Queue::fake();
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
        Queue::assertPushed(SendReportNotification::class);
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

    /** @test */
    public function user_can_submit_report_but_rate_limited()
    {
        $user = User::factory()->create();
        $station = Station::factory()->create();
        $this->login($user);

        $data = [
            'condition' => 'missing',
            'user_latitude' => $this->faker->latitude,
            'user_longitude' => $this->faker->longitude,
            'photo' => null
        ];

        $this->postJson(route('station.report.store', $station), $data);
        $this->postJson(route('station.report.store', $station), $data);
        $this->postJson(route('station.report.store', $station), $data);
        $this->postJson(route('station.report.store', $station), $data);
        $responseOne = $this->postJson(route('station.report.store', $station), $data);
        $responseTwo = $this->postJson(route('station.report.store', $station), $data);

        $responseOne->assertCreated();
        $responseTwo->assertStatus(429);
    }

    /** @test */
    public function authorized_user_should_not_rate_limited()
    {
        $this->login();
        $station = Station::factory()->create();

        $data = [
            'condition' => 'missing',
            'user_latitude' => $this->faker->latitude,
            'user_longitude' => $this->faker->longitude,
            'photo' => null
        ];

        $this->postJson(route('station.report.store', $station), $data);
        $this->postJson(route('station.report.store', $station), $data);
        $this->postJson(route('station.report.store', $station), $data);
        $this->postJson(route('station.report.store', $station), $data);
        $this->postJson(route('station.report.store', $station), $data);
        $response = $this->postJson(route('station.report.store', $station), $data);

        $response->assertCreated();
    }

    /** @test */
    public function operators_receive_notification_on_report_submitted()
    {
        Notification::fake();
        $operator = User::factory()->create(['permissions' => ['operate stations']]);
        $member = User::factory()->create();
        $manager = User::factory()->create(['permissions' => ['manage stations']]);
        $report = Report::factory()->create();

        SendReportNotification::dispatch($report);

        Notification::assertSentTo($operator, ReportSubmittedNotification::class);
        Notification::assertNotSentTo($member, ReportSubmittedNotification::class);
        Notification::assertNotSentTo($manager, ReportSubmittedNotification::class);
    }
}
