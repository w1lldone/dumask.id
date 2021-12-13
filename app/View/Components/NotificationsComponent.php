<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotificationsComponent extends Component
{
    public $notifications;

    public function __construct()
    {
        $this->notifications = auth()->user()->unreadNotifications()->paginate(5);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        // view yang berisi tombol dan dropdown
        return view('components.notifications', [
            'notifications' => $this->notifications
        ]);
    }
}