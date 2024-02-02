<?php

namespace Modules\EMap\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class OrganizationNotificationController extends Controller
{
    public function notification()
    {
        $notifications = auth('organization')->user()->notifications()->paginate(10);

        return view('emap::organization.notification', compact('notifications'));
    }

    public function readNotification(DatabaseNotification $databaseNotification)
    {
        $databaseNotification->markAsRead();

        return back();
    }

    public function readAllNotification()
    {
        foreach (auth('organization')->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return back();
    }
}
