<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(DatabaseNotification $notification) {
        if (Auth::id() !== $notification->notifiable_id) {
            abort(403);
        }

        $notification->markAsRead();

        return redirect($notification->data['url']);
    }
}
