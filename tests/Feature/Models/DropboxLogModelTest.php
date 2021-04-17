<?php

namespace Tests\Feature\Models;

use App\Models\DropboxLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DropboxLogModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_using_factory()
    {
        $dropboxLog = DropboxLog::factory()->create();

        $this->assertDatabaseHas('dropbox_logs', [
            'id' => $dropboxLog->id,
            'dropbox_id' => $dropboxLog->dropbox_id
        ]);
    }

    /** @test */
    public function it_has_many_children()
    {
        $log = DropboxLog::factory()->create();
        DropboxLog::factory(5)->create(['parent_id' => $log->id]);

        $this->assertCount(5, $log->children);
        $this->assertInstanceOf(DropboxLog::class, $log->children->first());
    }

    /** @test */
    public function it_belongs_to_a_parent()
    {
        $parent = DropboxLog::factory()->create();
        $child = DropboxLog::factory()->create(['parent_id' => $parent->id]);

        $this->assertTrue($parent->is($child->parent));
    }
}
