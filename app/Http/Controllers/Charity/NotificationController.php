<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{

    public function AllNotification()
    {
        $notifications = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('charity.user.notifications.all', compact('notifications'));
    }

    public function ViewNotification($code)
    {
        $notification = Notification::where('code', $code)->firstOrFail();

        # Only its owner can view notification details.
        if ($notification->user_id != Auth::id()) {
            $toastr = array(
                'message' => 'Sorry, notifications can only be viewed by its owner.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }

        # Set status from unread to read if clicked on view.
        $notification->read_status = 'read';
        $notification->save();

        return view('charity.user.notifications.view', compact('notification'));
    }

    public function DeleteNotification($code)
    {
        $notification = Notification::where('code', $code)->firstOrFail();
        $toastr = array();

        # Own Notifications can only be deleted by the user where the notification belongs to.
        if ($notification->user_id == Auth::user()->id) {
            $notification->delete();

            $toastr = array(
                'message' => 'Notification has been successfully deleted.',
                'alert-type' => 'success'
            );
        } else {
            $toastr = array(
                'message' => 'Notifications can only be deleted by its owner.',
                'alert-type' => 'error'
            );
        }

        return to_route('notifications.all')->with($toastr);
    }
}
