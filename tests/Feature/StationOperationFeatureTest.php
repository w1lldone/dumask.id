<?php

namespace Tests\Feature;

use App\Models\Dropbox;
use App\Models\DropboxLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationOperationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_deploy_a_dropbox()
    {
        $this->login();
        $dropbox = Dropbox::factory()->create();
        $timestamp = now()->toDateTimeString();

        $data = [
            'empty_weight' => 330,
            'timestamp' => $timestamp
        ];

        $response = $this->postJson(
            route('dropbox.operation.store', $dropbox),
            $data
        );

        $response->assertCreated()->assertJson([
            'weight' => 330,
            'starts_at' => $timestamp
        ]);
        $this->assertDatabaseHas('dropboxes', [
            'id' => $dropbox->id,
            'active_log_id' => $response->json('id')
        ]);
    }

    /** @test */
    public function user_can_replace_full_dropbox_with_empty_one()
    {
        $this->login();
        $timestamp = now()->toDateTimeString();
        $log = DropboxLog::factory()->create([
            'weight' => 330,
            'starts_at' => now()->subWeeks(2),
            'ends_at' => null
        ]);

        $data = [
            'empty_weight' => 350,
            'filled_weight' => 2500,
            'timestamp' => $timestamp,
        ];
        $response = $this->postJson(route('dropbox.operation.store', $log->dropbox_id), $data);

        $response->dump()->assertCreated();
        $this->assertDatabaseHas('dropbox_logs', [
            'id' => $log->id,
            'final_weight' => 2500,
            'weight' => 330,
            'ends_at' => $timestamp
        ]);
        $this->assertDatabaseHas('dropbox_logs', [
            'activity' => 'inspection',
            'parent_id' => $log->id,
            'final_weight' => 2500,
            'ends_at' => $timestamp
        ]);
    }
}
