<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        /** @var DatabaseNotification */
        $notification = $request->user()->notifications();

        if ($request->is_unread) {
            $notification = $notification->whereNull('read_at');
        }

        /** @var DatabaseNotificationCollection */
        $notifications = $notification->paginate();

        if ($request->wantsJson()) {
            return $notifications;
        }

        // View goes here
        return view('notifications.index', compact('notifications'));
    }

    public function show(Request $request, $notification)
    {
        /** @var DatabaseNotification */
        $notification = $request->user()->notifications()->findOrFail($notification);

        $notification->markAsRead();

        return redirect($notification->data['action']);
    }

    public function readAll(Request $request)
    {
        /** @var DatabaseNotificationCollection */
        $notifications = $request->user()->unreadNotifications;

        $notifications->markAsRead();

        return redirect('notification');
        //return response()->noContent();
    }
}
