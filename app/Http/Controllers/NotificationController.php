<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    /**
     * Mark the notification as read.
     * 
     * @param Request $request
     * @return Response
     */
    public function markAsRead(string $id) {
        if ($notification = Auth::user()->unreadNotifications()->where('id', $id)) {
            $notification->markAsRead();
            return Response('Success.', 200);
        }

        return Response('Not found.', 404);
    }

    /**
     * Mark all notifications as read for the logged in user.
     * 
     * @return Response
     */
    public function readAll() {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        return Response('Success.', 200);
    }
}
