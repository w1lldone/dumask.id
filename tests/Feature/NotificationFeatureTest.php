<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Notifications\ReportSubmittedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_get_all_notifications()
    {
        $this->login();
        $report = Report::factory()->create();

        $this->user->notify(new ReportSubmittedNotification($report));
        $response = $this->getJson(route('notification.index'));

        $response->assertOk()->assertJsonCount('1', 'data');
    }

    /** @test */
    public function user_can_get_unread_notifications()
    {
        $this->login();
        $report = Report::factory()->create();

        $this->user->notify(new ReportSubmittedNotification($report));
        $this->user->notify(new ReportSubmittedNotification($report));
        $this->user->unreadNotifications()->first()->markAsRead();
        $response = $this->getJson(route('notification.index', [
            'is_unread' => 1
        ]));

        $response->assertOk()->assertJsonCount('1', 'data');
    }

    /** @test */
    public function user_can_get_notification_details()
    {
        $this->login();
        $report = Report::factory()->create();

        $this->user->notify(new ReportSubmittedNotification($report));
        $notification = $this->user->unreadNotifications()->first();
        $response = $this->get(route('notification.show', $notification));

        $response->assertRedirect($notification->data['action']);
        $this->assertNotNull($notification->fresh()->read_at);
    }

    /** @test */
    public function user_can_read_all_unread_notifications()
    {
        $this->login();
        $report = Report::factory()->create();

        $this->user->notify(new ReportSubmittedNotification($report));
        $this->user->notify(new ReportSubmittedNotification($report));
        $response = $this->put(route('notification.readAll'));

        $response->assertNoContent();
        $this->assertEmpty($this->user->unreadNotifications()->count());
    }
}
