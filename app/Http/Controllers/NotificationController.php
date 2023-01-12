<?php

namespace App\Http\Controllers;

use App\ViewModels\NotificationViewModel;
use Illuminate\Support\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    /**
     * Mark the notification as read.
     * 
     * @param Request $request
     * @return Response
     */
    public function markAsRead(string $id) {
        if ($notification = Auth::user()->unreadNotifications()->where('id', $id)->first()) {
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

    /**
     * Returns all the unread notifications, and the last 10 read notifications.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotifications() {
        $map_to_view_models = function (DatabaseNotification $n) {
            return ['notification' => new NotificationViewModel($n)];
        };
        $get_view = function (Collection $list) {
            return view('components.list.list', [
                'itemtemplate' => 'components.notifications.small',
                'items' => $list
            ])->render();
        };

        $read_notifications = Auth::user()
            ->notifications()
            ->latest()
            ->whereNotNull('read_at')
            ->limit(10)
            ->get()
            ->map($map_to_view_models);
        $unread_notifications = Auth::user()
            ->unreadNotifications()
            ->latest()
            ->get()
            ->map($map_to_view_models);

        return response()->json([
            'read' => $get_view($read_notifications),
            'unread' => $get_view($unread_notifications),
            'unread_count' => $unread_notifications->count()
        ]);
    }

    /**
     * Show notifications page.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showNotificationsPage() {
        return view('notifications.page');
    }
}
