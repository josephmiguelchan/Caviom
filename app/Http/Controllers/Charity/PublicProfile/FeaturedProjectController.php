<?php

namespace App\Http\Controllers\Charity\PublicProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AuditLog;
use App\Models\CharitableOrganization;
use App\Models\Notification;
use App\Models\User;
use App\Models\Admin\FeaturedProject;
use App\Models\Admin\FeaturedProjectPhotos;
use App\Models\GiftGiving;
use App\Models\GiftGivingBeneficiary;
use App\Models\Project;
use App\Models\ProjectTask;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// use Image as InterventionImage;
// use App\Image;


class FeaturedProjectController extends Controller
{


    public function AllFeaturedProject()
    {
        # Retrieve All Featured Project

        $fps = FeaturedProject::where('charitable_organization_id', Auth::user()->charitable_organization_id)->orderBy('approval_status', 'ASC')->get();

        return view('charity.main.profile.featured-projects.all', compact('fps'));
    }

    public function ViewFeaturedProject($code)
    {
        $fp = FeaturedProject::where('code', $code)->firstOrFail();

        return view('charity.main.profile.featured-projects.view', compact('fp'));
    }

    public function NewFeaturedProject()
    {
        # Checks if user has at least 450 Star Tokens or 1 Credit
        if (Auth::user()->charity->star_tokens < 450 and Auth::user()->charity->featured_project_credits < 1) {
            $toastr = array(
                'message' => 'Sorry, your Charitable Organization does not have sufficient Star Tokens / Featured Project Credits.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        } else {
            return view('charity.main.profile.featured-projects.new');
        }
    }

    public function StoreNewFeaturedProject(Request $request)
    {
        # Checks if user has at least 450 Star Tokens or 1 Credit
        if (Auth::user()->charity->star_tokens < 450 and Auth::user()->charity->featured_project_credits < 1) {
            $toastr = array(
                'message' => 'Sorry, your Charitable Organization does not have sufficient Star Tokens / Featured Project Credits.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }

        # Validation Rules
        $request->validate([
            'name' => 'required|unique:featured_projects|min:5|max:50',
            'cover_photo' => 'required|mimes:jpg,png,jpeg|max:2048|file',
            'started_on' => 'required',
            'total_beneficiaries ' => 'nullable|integer|between:1,1000',
            'sponsors' => 'nullable',
            'venue' => 'nullable|max:255',
            'objective' => 'required|min:20|max:2000',
            'message' => 'nullable|min:20|max:2000',

            'featured_photo_1' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_2' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_3' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_4' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_5' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',

        ], [
            //for custom message if need ， just delete it if no need custom message

        ]);

        # Store Data to featured_projects table
        $fp = new FeaturedProject;
        $fp->code = Str::uuid()->toString();
        $fp->charitable_organization_id = Auth::user()->chartiable_organization_id;
        $fp->name = $request->name;

        # Insert Cover Photo to database
        if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();

            // Image::make($file)->resize(200, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            $file->move(public_path('upload/featured_project/'), $filename);
            $fp->cover_photo = $filename;
        }

        $fp->charitable_organization_id = Auth::user()->charitable_organization_id;
        $fp->started_on = $request->started_on;
        $fp->sponsors = $request->sponsors;
        $fp->total_beneficiaries = $request->total_beneficiaries;
        $fp->venue = $request->venue;
        $fp->objectives = $request->objective;
        $fp->message = $request->message;

        # Check what are being used for paid for the project
        if (Auth::user()->charity->featured_project_credits >= 1) {
            # deduct credits
            $current_credit = CharitableOrganization::find(Auth::user()->charitable_organization_id);
            $current_credit->featured_project_credits = $current_credit->featured_project_credits - 1;
            $current_credit->save();

            # paid_using = Credit
            $fp->paid_using = 'Credit';
        } else {
            # Deduct Balance
            $current_bal = CharitableOrganization::find(Auth::user()->charitable_organization_id);
            $current_bal->star_tokens = $current_bal->star_tokens - 450;
            $current_bal->save();

            # paid_using = Star Tokens
            $fp->paid_using = 'Star Tokens';
        }
        $fp->created_at = Carbon::now();
        $fp->save();

        $fphoto = new FeaturedProjectPhotos;
        $fphoto->featured_project_id = $fp->id;
        $fphoto->created_at = Carbon::now();

        # Insert feature_photos
        for ($i = 1; $i < 6; $i++) {
            $fileInputName = 'featured_photo_' . $i;
            if ($request->$fileInputName) {
                $file = $request->file($fileInputName);
                $filename = $fileInputName . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/featured_project/'), $filename);
                $fphoto->$fileInputName = $filename;
                $fphoto->save();
            }
        }
        $fphoto->save();

        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'INSERT';
        $log_in->charitable_organization_id = $fp->charitable_organization_id;
        $log_in->table_name = 'Featured Project';
        $log_in->record_id = $fp->code;
        $log_in->action = Auth::user()->role . ' submitted pending Featured Project
                                [ ' . $request->name . ' ] using Star Token/ Free Featured Project Credit';
        $log_in->performed_at = Carbon::now();
        $log_in->save();


        # Send Notification to each user in their Charitable Organizations
        $users = User::where('charitable_organization_id', $fp->charitable_organization_id)
            ->where('status', 'Active')
            ->where('role', 'Charity Admin')
            ->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Featured Project';
            $notif->subject = 'Pending Project Submitted';
            $notif->message = 'A pending featured project request [ ' . $request->name . ' ] has been successfully created by ' .
                Auth::user()->role . ' [ ' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name . ' ]. Kindly wait
                for 2 to 3 working days for Caviom to review your project before it can be visible to your Charitable Organization public profile.';
            $notif->icon = 'mdi mdi-heart';
            $notif->color = 'success';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        # send success toastr
        $toastr = array(
            'message' => 'Featured Project Added Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('charity.profile.feat-project.all')->with($toastr);
    }

    public function AddExistedGiftFeaturedProject($code)
    {
        # Checks if user has at least 450 Star Tokens or Credit
        if (Auth::user()->charity->star_tokens < 450 and Auth::user()->charity->featured_project_credits < 1) {
            $toastr = array(
                'message' => 'Sorry, your Charitable Organization does not have sufficient Star Tokens / Featured Project Credits.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        } else {
            $giftgiving = GiftGiving::where('code', $code)->firstOrFail();



            return view('charity.main.profile.featured-projects.addgift', compact('giftgiving'));
        }
    }

    public function StoreExistedGiftFeaturedProject(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:featured_projects|min:5|max:50',
            'cover_photo' => 'required|mimes:jpg,png,jpeg|max:2048|file',
            'started_on' => 'required',
            'total_beneficiaries ' => 'nullable|integer|between:1,1000',
            'sponsors' => 'nullable',
            'venue' => 'nullable|max:255',
            'objective' => 'required|min:20|max:2000',
            'message' => 'nullable|min:20|max:2000',

            'featured_photo_1' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_2' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_3' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_4' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_5' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',

        ], [
            //for custom message if need ， just delete it if no need custom message

        ]);


        # Store Data to featured_projects table
        $fp = new FeaturedProject;
        $fp->code = Str::uuid()->toString();
        $fp->charitable_organization_id = Auth::user()->chartiable_organization_id;
        $fp->name = $request->name;

        # Insert Cover Photo to database
        if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/featured_project/'), $filename);
            $fp->cover_photo = $filename;
        }
        $fp->charitable_organization_id = Auth::user()->charitable_organization_id;
        $fp->started_on = $request->started_on;
        $fp->sponsors = $request->sponsors;
        $fp->total_beneficiaries = $request->total_beneficiaries;
        $fp->venue = $request->venue;
        $fp->objectives = $request->objective;
        $fp->message = $request->message;

        # Check what are being used for paid for the project
        if (Auth::user()->charity->featured_project_credits >= 1) {
            # deduct credits
            $current_credit = CharitableOrganization::find(Auth::user()->charitable_organization_id);
            $current_credit->featured_project_credits = $current_credit->featured_project_credits - 1;
            $current_credit->save();

            # paid_using = Credit
            $fp->paid_using = 'Credit';
        } else {
            # Deduct Balance
            $current_bal = CharitableOrganization::find(Auth::user()->charitable_organization_id);
            $current_bal->star_tokens = $current_bal->star_tokens - 450;
            $current_bal->save();

            # paid_using = Star Tokens
            $fp->paid_using = 'Star Tokens';
        }
        $fp->created_at = Carbon::now();
        $fp->save();



        $fphoto = new FeaturedProjectPhotos;
        $fphoto->featured_project_id = $fp->id;
        $fphoto->created_at = Carbon::now();

        # Insert feature_photos
        for ($i = 1; $i < 6; $i++) {
            $fileInputName = 'featured_photo_' . $i;
            if ($request->$fileInputName) {
                $file = $request->file($fileInputName);
                $filename = $fileInputName . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/featured_project/'), $filename);
                $fphoto->$fileInputName = $filename;
                $fphoto->save();
            }
        }


        $fphoto->save();

        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'INSERT';
        $log_in->charitable_organization_id = $fp->charitable_organization_id;
        $log_in->table_name = 'Featured Project';
        $log_in->record_id = $fp->code;
        $log_in->action = Auth::user()->role . ' submitted pending Featured Project
                                    [ ' . $request->name . ' ] using Star Token/ Free Featured Project Credit';
        $log_in->performed_at = Carbon::now();
        $log_in->save();



        # Send Notification to each user in their Charitable Organizations
        $users = User::where('charitable_organization_id', $fp->charitable_organization_id)
            ->where('status', 'Active')
            ->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Featured Project';
            $notif->subject = 'Pending Project Submitted';
            $notif->message = 'Your pending featured project request [ ' . $request->name . ' ] has been successfully submited.
                                Kindly wait for 2 to 3 working days for Caviom to review your project before it can be visible
                                 to your Charitable Organization public profile.';
            $notif->icon = 'mdi mdi-book-plus-outline';
            $notif->color = 'success';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        # send success toastr
        $toastr = array(
            'message' => 'Featured Project Added Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('charity.profile.feat-project.all')->with($toastr);
    }

    public function AddExistedTaskFeaturedProject($code)
    {
        # Checks if user has at least 450 Star Tokens or Credit
        if (Auth::user()->charity->star_tokens < 450 and Auth::user()->charity->featured_project_credits < 1) {
            $toastr = array(
                'message' => 'Sorry, your Charitable Organization does not have sufficient Star Tokens / Featured Project Credits.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        } else {
            $project = Project::where('code', $code)->firstOrFail();

            return view('charity.main.profile.featured-projects.addtask', compact('project'));
        }
    }

    public function StoreExistedProjectFeaturedProject(Request $request, $code)
    {
        $request->validate([
            'name' => 'required|unique:featured_projects|min:5|max:50',
            'cover_photo' => 'required|mimes:jpg,png,jpeg|max:2048|file',
            'started_on' => 'required',
            'total_beneficiaries ' => 'nullable|integer|between:1,1000',
            'sponsors' => 'nullable',
            'venue' => 'nullable|max:255',
            'objective' => 'required|min:20|max:2000',
            'message' => 'nullable|min:20|max:2000',

            'featured_photo_1' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_2' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_3' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_4' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'featured_photo_5' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',

        ], [
            //for custom message if need ， just delete it if no need custom message

        ]);

        # retrieve project recprd
        $project = Project::where('code', $code)->firstOrFail();

        # Store Data to featured_projects table
        $fp = new FeaturedProject;
        $fp->code = Str::uuid()->toString();
        $fp->charitable_organization_id = Auth::user()->chartiable_organization_id;
        $fp->name = $request->name;

        # Insert Cover Photo to database
        if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/featured_project/'), $filename);
            $fp->cover_photo = $filename;
        }


        $fp->charitable_organization_id = Auth::user()->charitable_organization_id;
        $fp->started_on = $request->started_on;
        $fp->sponsors = $request->sponsors;
        $fp->total_beneficiaries = $request->total_beneficiaries;
        $fp->venue = $request->venue;
        $fp->objectives = $request->objective;
        $fp->message = $request->message;


        # Check what are being used for paid for the project
        if (Auth::user()->charity->featured_project_credits >= 1) {
            # deduct credits
            $current_credit = CharitableOrganization::find(Auth::user()->charitable_organization_id);
            $current_credit->featured_project_credits = $current_credit->featured_project_credits - 1;
            $current_credit->save();

            # paid_using = Credit
            $fp->paid_using = 'Credit';
        } else {
            # Deduct Balance
            $current_bal = CharitableOrganization::find(Auth::user()->charitable_organization_id);
            $current_bal->star_tokens = $current_bal->star_tokens - 450;
            $current_bal->save();

            # paid_using = Star Tokens
            $fp->paid_using = 'Star Tokens';
        }
        $fp->created_at = Carbon::now();
        $fp->save();


        $fphoto = new FeaturedProjectPhotos;
        $fphoto->featured_project_id = $fp->id;
        $fphoto->created_at = Carbon::now();

        # Insert feature_photos
        for ($i = 1; $i < 6; $i++) {
            $fileInputName = 'featured_photo_' . $i;
            if ($request->$fileInputName) {
                $file = $request->file($fileInputName);
                $filename = $fileInputName . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/featured_project/'), $filename);
                $fphoto->$fileInputName = $filename;
                $fphoto->save();
            }
        }
        $fphoto->save();

        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'INSERT';
        $log_in->charitable_organization_id = $fp->charitable_organization_id;
        $log_in->table_name = 'Featured Project';
        $log_in->record_id = $fp->code;
        $log_in->action = Auth::user()->role . ' submitted pending Featured Project
                                     [ ' . $request->name . ' ] using Star Token/ Free Featured Project Credit';
        $log_in->performed_at = Carbon::now();
        $log_in->save();



        # Send Notification to each user in their Charitable Organizations
        $users = User::where('charitable_organization_id', $fp->charitable_organization_id)
            ->where('status', 'Active')
            ->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Featured Project';
            $notif->subject = 'Pending Project Submitted';
            $notif->message = 'Your pending featured project request [ ' . $request->name . ' ] has been successfully submited.
                                 Kindly wait for 2 to 3 working days for Caviom to review your project before it can be visible
                                  to your Charitable Organization public profile.';
            $notif->icon = 'mdi mdi-book-plus-outline';
            $notif->color = 'success';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        # send success toastr
        $toastr = array(
            'message' => 'Featured Project Added Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('charity.profile.feat-project.all')->with($toastr);
    }
}
