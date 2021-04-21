<?php

namespace Tests\Feature\Models;

use App\Models\Dropbox;
use App\Models\DropboxLog;
use App\Models\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DropboxModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_using_factory()
    {
        Dropbox::factory(3)->create();

        $this->assertDatabaseCount('dropboxes', 3);
    }

    /** @test */
    public function it_belongs_to_a_station()
    {
        $dropbox = Dropbox::factory()->create();

        $this->assertInstanceOf(Station::class, $dropbox->station);
    }

    /** @test */
    public function it_has_many_logs()
    {
        $dropbox = Dropbox::factory()->hasDropboxLogs(2)->create();

        $this->assertCount(2, $dropbox->dropboxLogs);
        $this->assertInstanceOf(DropboxLog::class, $dropbox->dropboxLogs->first());
    }

    /** @test */
    public function it_automatically_generates_image_url()
    {
        $dropbox = Dropbox::factory()->create()->toArray();

        $this->assertNotEmpty($dropbox['image_url']);
    }
}
