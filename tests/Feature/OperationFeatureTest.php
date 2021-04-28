<?php

namespace Tests\Feature;

use App\Models\Dropbox;
use App\Models\DropboxLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OperationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_deploy_a_dropbox()
    {
        $this->login();
        $dropbox = Dropbox::factory()->create();
        $timestamp = now()->toAtomString();

        $data = [
            'dropbox_id' => $dropbox->id,
            'empty_weight' => 330,
            'timestamp' => $timestamp
        ];

        $response = $this->postJson(
            route('operation.replace', $dropbox->station_id),
            $data
        );

        $response->assertCreated()->assertJson([
            'weight' => 330,
            'user_id' => $this->user->id
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
            'activity' => 'replacement',
            'weight' => 330,
            'starts_at' => now()->subWeeks(2),
            'ends_at' => null
        ]);

        $data = [
            'dropbox_id' => $log->dropbox_id,
            'empty_weight' => 350,
            'filled_weight' => 2500,
            'timestamp' => $timestamp,
        ];
        $response = $this->postJson(route('operation.replace', $log->dropbox->station_id), $data);

        $response->assertCreated();
        $this->assertDatabaseHas('dropbox_logs', [
            'id' => $log->id,
            'final_weight' => 2500,
            'weight' => 330,
            'ends_at' => $timestamp,
        ]);
        $this->assertDatabaseHas('dropbox_logs', [
            'activity' => 'inspection',
            'parent_id' => $log->id,
            'final_weight' => 2500,
            'ends_at' => $timestamp,
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    public function user_can_inspect_active_dropbox()
    {
        $this->login();
        $timestamp = now()->toAtomString();
        $log = DropboxLog::factory()->create([
            'activity' => 'replacement',
            'weight' => 330,
            'starts_at' => now()->subWeeks(2),
            'ends_at' => null
        ]);

        $data = [
            'dropbox_id' => $log->dropbox_id,
            'filled_weight' => 900,
            'timestamp' => $timestamp,
        ];
        $response = $this->postJson(route('operation.inspect', $log->dropbox->station_id), $data);

        $response->assertCreated()
            ->assertJson([
                'activity' => 'inspection',
                'final_weight' => 900,
                'parent_id' => $log->id,
                'ends_at' => $timestamp
            ]);

        $this->assertDatabaseHas('dropbox_logs', [
            'id' => $log->id,
            'final_weight' => 900,
            'ends_at' => $timestamp
        ]);
    }

    /** @test */
    public function user_can_inspect_old_records()
    {
        $this->login();
        $parent = DropboxLog::factory()->create([
            'activity' => 'replacement',
            'weight' => 330,
            'starts_at' => now()->subWeeks(2),
            'ends_at' => null
        ]);
        $latestLog = DropboxLog::factory()->create([
            'dropbox_id' => $parent->dropbox_id,
            'activity' => 'inspection',
            'parent_id' => $parent->id,
            'final_weight' => 2500,
            'ends_at' => now(),
            'user_id' => $this->user->id
        ]);

        $data = [
            'dropbox_id' => $parent->dropbox_id,
            'filled_weight' => 900,
            'timestamp' => now()->subWeek(),
        ];
        $this->postJson(route('operation.inspect', $parent->dropbox->station_id), $data);

        $this->assertDatabaseHas('dropbox_logs', [
            'id' => $parent->id,
            'final_weight' => $latestLog->final_weight,
            'ends_at' => $latestLog->ends_at,
        ]);
    }

    /** @test */
    public function user_can_delete_dropbox_log()
    {
        $this->login();
        $parent = DropboxLog::factory()->create([
            'activity' => 'replacement',
            'weight' => 330,
            'starts_at' => now()->subWeeks(2),
            'ends_at' => null
        ]);
        $latestLog = DropboxLog::factory()->create([
            'dropbox_id' => $parent->dropbox_id,
            'activity' => 'inspection',
            'parent_id' => $parent->id,
            'final_weight' => 2500,
            'ends_at' => now(),
            'user_id' => $this->user->id
        ]);

        $response = $this->deleteJson(route('operation.destroy', $latestLog->id));

        $response->assertNoContent();
        $this->assertDeleted($latestLog);
    }

}
