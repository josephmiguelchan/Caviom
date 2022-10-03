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
        // $notifications = Auth::user()->notifications;

        $notifications = Notification::where('user_id', Auth::user()->id)->latest()->get();

        return view('charity.user.notifications.all', compact('notifications'));
    } // End Method


    public function ViewNotification($code)
    {
        $notification = Notification::where('code', $code)->firstOrFail();
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

    /*public function NotificationsData()
    {
        $notifications = Notification::latest()->limit(3)->get();

        $jsonntifcaiton = json_encode($notifications);
    }*/
}
