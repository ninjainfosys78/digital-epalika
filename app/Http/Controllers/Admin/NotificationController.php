<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function notification(): Factory|View|Application
    {
        $notifications = auth()->user()->notifications()->paginate(10);

        return view('admin.notification.index', compact('notifications'));
    }

    public function readNotification(DatabaseNotification $databaseNotification)
    {
        $databaseNotification->markAsRead();
        toast('नोटिफिकेसन सफलता पुर्बक हेरियो', 'success');
        return back();
    }

    public function readAllNotification()
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        toast('सबै नोटिफिकेसन सफलता पुर्बक हेरियो', 'success');
        return back();
    }
}
