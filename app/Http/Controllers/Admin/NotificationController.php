<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        try {
            $notiId = $request->only('id');
            $notification = Helpers::findNotificationById($notiId);
            $markAsRead = Helpers::markAsRead($notification);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json(['markAsRead' => true]);
    }

    public function markAsReadAll()
    {
        try {
            $notification = Helpers::getAllNotification();
            $markAsRead = Helpers::markAsRead($notification);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json(['markAsReadAll' => true]);
    }

    public function getLatestNotification()
    {
        $notification = Helpers::getLatestNotification();

        return response()->json(compact('notification'));
    }
}
