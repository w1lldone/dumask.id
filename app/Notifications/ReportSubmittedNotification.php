<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportSubmittedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $report;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Report $report)
    {
        $this->report = $report->load('station');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Laporan Kondisi Dropbox Diterima')
                    ->greeting("Hai {$notifiable->name}")
                    ->line("Pengguna telah melaporkan kondisi dropbox pada station.")
                    ->line("Nama Station: {$this->report->station->name}")
                    ->line("Kondisi Dropbox: {$this->report->description()}")
                    ->line("Anda bisa melihat detail laporan melalui tombol di bawah ini.")
                    ->action('Lihat Laporan', route('notification.show', $this->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => "Laporan Kondisi Dropbox Diterima",
            'body' => "Laporan Baru untuk Station {$this->report->station->name}",
            'action' => route('station.report.index', $this->report->station_id),
            'icon' => 'mdi-home-alert'
        ];
    }
}
