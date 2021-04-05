<?php

namespace Tests\Feature;

use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationScheduleFeatureTest extends TestCase
{
    /** @test */
    public function user_can_store_station_schedule()
    {
        $this->login();
        $data = Schedule::factory()->make()->toArray();

        $response = $this->postJson(
            route('station.schedule.store', $data['station_id']),
            $data
        );

        $response->assertCreated()->assertJson($data);
    }

    /** @test */
    public function user_can_update_station_schedules()
    {
        $this->login();
        $schedule = Schedule::factory()->create();
        $data = [
            'opened_at' => "08:00",
            'closed_at' => "09:00"
        ];

        $response = $this->putJson(
            route('station.schedule.update', [$schedule->station_id, $schedule->id]),
            $data
        );

        $response->assertOk()->assertJson($data);
    }

    /** @test */
    public function user_can_delete_station_schedules()
    {
        $this->login();
        $schedule = Schedule::factory()->create();

        $response = $this->deleteJson(route('station.schedule.destroy', [$schedule->station_id, $schedule->id]));

        $response->assertNoContent();
        $this->assertDeleted($schedule);
    }
}
