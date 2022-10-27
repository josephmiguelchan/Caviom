<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FeaturedProject;
use App\Models\Admin\FeaturedProjectPhotos;
use App\Models\Admin\Notifier;
use App\Models\AuditLog;
use App\Models\CharitableOrganization;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Carbon;

class FeaturedProjectController extends Controller
{
    public function AllFeaturedProject()
    {
        # Retrieve All Featured Project

        $fps = FeaturedProject::orderBy('approval_status', 'ASC')->get();

        return view('admin.main.featured-projects.all', compact('fps'));
    }

    public function ViewFeaturedProject($code)
    {
        $fp = FeaturedProject::where('code', $code)->firstOrFail();

        $fpPhotos = FeaturedProjectPhotos::where('featured_project_id', $fp->id)->get();

        $FpRemarks = Notifier::where('category', 'Featured Project Request')->get();


        return view('admin.main.featured-projects.view', compact('fp', 'fpPhotos', 'FpRemarks'));
    }

    public function RejectFeaturedProject(Request $request, $code)
    {

        $fp = FeaturedProject::where('code', $code)->firstOrFail();

        # Update the table
        $fp->approval_status = 'Rejected';

        # Set the remarks MESSAGE based on the value of profile's remarks from Notifiers dropdown table.
        if ($request->remarks_subject == null) {
            $fp->remarks_subject = null;
            $fp->remarks_message = null;
        } else {
            $fp->remarks_subject = $request->remarks_subject;
            $remarks_from_notifiers = Notifier::where('category', 'Featured Project Request')->get();
            foreach ($remarks_from_notifiers as $notifier) {
                switch ($request->remarks_subject) {
                    case $notifier->subject:
                        $fp->remarks_message = $notifier->message;
                        break;
                }
            }
        }


        $fp->status_updated_at = Carbon::now();
        $fp->reviewed_by  = Auth::user()->id;
        $fp->updated_at = Carbon::now();
        $fp->update();

        # Refund the credit/Star Token
        $current_bal = CharitableOrganization::findOrFail($fp->charitable_organization_id);
        if ($fp->paid_using == 'Star Tokens') {
            $current_bal->star_tokens = $current_bal->star_tokens + 450;
            $current_bal->save();
        } elseif ($fp->paid_using == 'Credit') {
            $current_bal->featured_project_credits = $current_bal->featured_project_credits + 1;
            $current_bal->save();
        }

        # Create Audits Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = $fp->charitable_organization_id;
        $log_in->table_name = 'Charitable Organization , Featured Project';
        $log_in->record_id = $fp->id;
        $log_in->action = Auth::user()->role . ' declined Featured Project Request of
                                [ ' . $fp->name . ' ] with Remarks [ ' . $fp->remarks_subject . ' ]. ' .
            $fp->paid_using . ' has been refunded';
        $log_in->performed_at = Carbon::now();
        $log_in->save();



        # Send notifications
        $users = User::where('charitable_organization_id', $fp->charitable_organization_id)
            ->where('status', 'Active')
            ->where('role', 'Charity Admin')
            ->get();

        foreach ($users as $user) {

            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Featured Project';
            $notif->subject = 'Featured Project Update';
            $notif->message = 'Your featured project [ ' . $fp->name . ' ] has been reviewed by Caviom. Unfortunately,
                your featured project request has been declined due to [ ' . $request->remarks_subject . ' ]. ' . $fp->remarks_message . ' Your '
                . $fp->paid_using . ' has been refunded back to your Charitable Organization.';
            $notif->icon = 'mdi mdi-heart-remove';
            $notif->color = 'danger';
            $notif->created_at = Carbon::now();
            $notif->save();
        }


        # Send Success toastr
        $toastr = array(
            'message' => 'The Featured Project has been successfully rejected.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);
    }

    public function ApproveFeaturedProject($code)
    {

        # Retrieve FeaturedProject Detail

        $fp = FeaturedProject::where('code', $code)->firstOrFail();

        # Update the table
        $fp->approval_status = 'Approved';
        $fp->visibility_status = 'Visible';
        $fp->status_updated_at = Carbon::now();
        $fp->reviewed_by = Auth::user()->id;
        $fp->updated_at = Carbon::now();
        $fp->update();


        # Create Audits Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = $fp->charitable_organization_id;
        $log_in->table_name = 'Charitable Organization , Featured Project';
        $log_in->record_id = $fp->id;
        $log_in->action = Auth::user()->role . ' approved Featured Project Request of [' . $fp->name . '].';
        $log_in->performed_at = Carbon::now();
        $log_in->save();


        # Send notifications
        $users = User::where('charitable_organization_id', $fp->charitable_organization_id)
            ->where('status', 'Active')
            ->where('role', 'Charity Admin')
            ->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Featured Project';
            $notif->subject = 'Approved Request';
            $notif->message = 'Congratulations! After carefully reviewing your submitted featured project request,
                            Caviom has approved your project to be featured in your Charitable Organizations public
                            profile and will now be visible.';
            $notif->icon = 'mdi mdi-heart-plus-outline';
            $notif->color = 'success';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        # Send Success Toastr
        $toastr = array(
            'message' => ' The Featured Project has been successfully approved.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);
    }
}
