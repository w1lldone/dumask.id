<?php

namespace Tests\Feature\Models;

use App\Models\Report;
use App\Models\Station;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_using_factory()
    {
        $report = Report::factory()->create();

        $this->assertInstanceOf(Report::class, $report);
    }

    /** @test */
    public function it_belongs_to_station()
    {
        $report = Report::factory()->create();

        $this->assertInstanceOf(Station::class, $report->station);
    }

    /** @test */
    public function it_belongs_to_reporter()
    {
        $report = Report::factory()->create();

        $this->assertInstanceOf(User::class, $report->reporter);
    }

    /** @test */
    public function it_belongs_to_resolver()
    {
        $report = Report::factory()->create([
            'resolved_at' => now(),
            'resolver_id' => User::factory()
        ]);

        $this->assertInstanceOf(User::class, $report->resolver);
    }
}
