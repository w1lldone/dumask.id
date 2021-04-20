<?php

namespace Tests\Feature;

use App\Models\Dropbox;
use App\Models\DropboxLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DropboxOperationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_deploy_a_dropbox()
    {
        $this->login();
        $dropbox = Dropbox::factory()->create();
        $timestamp = now()->toAtomString();

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
            'empty_weight' => 350,
            'filled_weight' => 2500,
            'timestamp' => $timestamp,
        ];
        $response = $this->postJson(route('dropbox.operation.store', $log->dropbox_id), $data);

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
            'filled_weight' => 900,
            'timestamp' => $timestamp,
        ];
        $response = $this->putJson(route('dropbox.operation.inspect', $log->dropbox_id), $data);

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
}
