<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * ✅ Mark a single notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * ✅ Mark all unread notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read.');
    }
}
