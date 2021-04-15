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

        $this->assertDatabaseHas('dropbox_logs', $dropboxLog->toArray());
    }
}
