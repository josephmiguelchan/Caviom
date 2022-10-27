<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Admin\FeaturedProject;
use App\Models\AuditLog;
use App\Models\Benefactor;
use App\Models\Beneficiary;
use App\Models\Notification;
use App\Models\ProjectTask;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class CharityController extends Controller
{
    // Redirect to Dashboard
    public function showDashboard()
    {
        if (Auth::user()->role == "Root Admin") {
            return to_route('admin.panel');
        }

        $admin_count = User::where('charitable_organization_id', Auth::user()->charity->id)->where('status', 'Active')->where('role', 'Charity Admin')->count();
        $assoc_count = User::where('charitable_organization_id', Auth::user()->charity->id)->where('status', 'Active')->where('role', 'Charity Associate')->count();
        $benefic_count = Beneficiary::where('charitable_organization_id', Auth::user()->charity->id)->count();
        $users_count = User::where('charitable_organization_id', Auth::user()->charity->id)->where('status', 'Active')->count();
        $feat_count = FeaturedProject::where('charitable_organization_id', Auth::user()->charity->id)->where('approval_status', 'Approved')->count();

        $pending_tasks = ProjectTask::whereRelation('project', 'charitable_organization_id', Auth::user()->charity->id)->where('status', 'Pending')->count();
        $in_progress_tasks = ProjectTask::whereRelation('project', 'charitable_organization_id', Auth::user()->charity->id)->where('status', 'In-Progress')->count();
        $completed_tasks = ProjectTask::whereRelation('project', 'charitable_organization_id', Auth::user()->charity->id)->where('status', 'Completed')->count();

        $opportunities = (Volunteer::where('charitable_organization_id', Auth::user()->charity->id)->count()) + (Benefactor::where('charitable_organization_id', Auth::user()->charity->id)->count());

        return view('charity.index', compact([
            'admin_count', 'assoc_count', 'benefic_count', 'users_count', 'feat_count',
            'pending_tasks', 'in_progress_tasks', 'completed_tasks',
            'opportunities'
        ]));
    }

    // Logout User
    public function destroy(Request $request)
    {
        $user = Auth::user();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user and $user->status == 'Active') {

            # Create Audit Log for Logout
            $log = new AuditLog;
            $log->user_id = $user->id;
            $log->action_type = 'LOGOUT';
            $log->charitable_organization_id = $user->charitable_organization_id;
            $log->table_name = null;
            $log->record_id = null;
            $log->action = $user->role . ' has successfully logged out on ' . Carbon::now()->toDayDateTimeString() . ' using Client IP Address: ' .
                $request->ip();
            $log->performed_at = Carbon::now();
            $log->save();
        }

        return redirect('/login');
    }

    // Show User Profile
    public function showProfile()
    {
        return view('charity.user.profile');
    }

    // Redirect to Edit Profile Page
    public function editProfile()
    {
        return view('charity.user.edit');
    }

    // Update User Profile
    public function storeProfile(Request $request)
    {
        # Validate Form Before Updating User Profile
        $request->validate(
            [
                # Profile Picture
                'profile_image' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],

                # Full Name
                'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],

                # Contact and Occupation
                'cel_no' => ['required', 'regex:/(09)[0-9]{9}/', 'unique:user_infos'], // 09 + (Any 9-digit number from 1-9)
                'tel_no' => ['nullable', 'regex:/(8)[0-9]{7}/'], // 8 + (Any 7-digit number from 1-9)
                'work_position' => ['required', 'string', 'min:4', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'organizational_id_no' => ['nullable', 'integer', 'numeric', 'min:100', 'max:9999999999', 'unique:user_infos'], // !! Must be unique only to their charitable organization only.

                # Current address
                'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                'province' => ['required', 'string', 'min:3', 'max:64'],
                'region' => ['required', 'string', 'min:3', 'max:64'],
                'city' => ['required', 'string', 'min:3', 'max:64'],
                'barangay' => ['required', 'string', 'min:3', 'max:64'],
                'postal_code' => ['required', 'integer', 'digits:4'],
            ],
            [
                # Custom Error Messages
                'profile_image.max' => 'Your profile picture must not exceed the file size of 2mb.',
                'first_name.regex' => 'The first name field must not include number/s.',
                'middle_name.regex' => 'The middle name field must not include number/s.',
                'work_position.regex' => 'Work position must not include number(s) or must be a valid format.',
                'last_name.regex' => 'The last name field must not include number/s.',
                'cel_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
                'tel_no.regex' => 'The tel no format must be followed. Ex. 82531234',
                'is_agreed.required' => 'You must first agree before submitting.',
            ]
        );


        # Retrieves the account details of currently logged in user.
        $id = Auth::id();
        $thisUser = User::findOrFail($id);
        $thisUserInfo = UserInfo::where('user_id', $id)->firstOrFail();


        # Update Profile Picture
        if ($request->file('profile_image')) {

            # Delete old Profile Image if exists
            $oldImg = $thisUser->profile_image;
            if ($oldImg) unlink(public_path('upload/avatar_img/') . $oldImg);

            # Replace with Uploaded New Profile Image
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/avatar_img/'), $filename);
            $thisUser->profile_image = $filename;
            $thisUser->save();
        }


        # Begin updating the personal information of the retrieved user.
        UserInfo::findOrFail($thisUserInfo->id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'cel_no' => $request->cel_no,
            'tel_no' => $request->tel_no,
            'work_position' => $request->work_position,
            'updated_at' => Carbon::now(),
        ]);


        # Begin updating the User Address of the retrieved user.
        Address::findOrFail($thisUserInfo->address_id)->update([
            'address_line_one' => $request->address_line_one,
            'address_line_two' => $request->address_line_two,
            'region' => $request->region,
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'barangay' => $request->barangay,
        ]);


        # Create Audit Logs for Edit Profile
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'UPDATE';
        $log->charitable_organization_id = null;
        $log->table_name = 'User, UserInfo, Address';
        $log->record_id = $thisUser->code;
        $log->action = $thisUser->role . ' [' . $thisUser->info->first_name . ' ' . $thisUser->info->last_name . '] updated their own profile.';
        $log->performed_at = Carbon::now();
        $log->save();


        # Return the user back with success toastr message
        $toastr = array(
            'message' => 'Profile has been saved successfully!',
            'alert-type' => 'success',
        );

        return to_route('user.profile')->with($toastr);
    }

    // Change User Password
    public function editPassword()
    {
        return view('charity.user.password');
    }

    // Update User Password
    public function storePassword(Request $request)
    {
        # Validate Form before updating password
        $request->validate(
            [
                'old_password' => ['required'],
                'new_password' => ['required', 'max:20', Rules\Password::defaults(), 'different:old_password'],
                'confirm_password' => ['required', 'same:new_password'],
            ],
            [
                'new_password.different' => 'Your new password cannot be the same with your current password.',
            ]
        );

        # Check if the entered current password matches in the Database
        $hashedPW = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPW)) {

            # Update User password
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->new_password);
            $user->save();


            # Create a Notification in-app
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'User';
            $notif->subject = 'Change Password';
            $notif->message = 'You have successfully updated your own password on ' . Carbon::now()->toDayDateTimeString() . '.';
            $notif->icon = 'mdi mdi-form-textbox-password';
            $notif->color = 'info';
            $notif->created_at = Carbon::now();
            $notif->save();


            # Create Audit Logs Record but with the Password being redacted
            $log = new AuditLog;
            $log->user_id = $user->id;
            $log->action_type = 'UPDATE';
            $log->charitable_organization_id = null;
            $log->table_name = 'User';
            $log->record_id = $user->code;
            $log->action = $user->role . ' [' . $user->info->first_name . ' ' . $user->info->last_name . '] updated their own password.';
            $log->performed_at = Carbon::now();
            $log->save();


            # Success toastr message
            $toastr = array(
                'message' => 'Password has been updated successfully!',
                'alert-type' => 'success',
            );
        } else {

            # Throws an error message if current password did not match
            $toastr = array(
                'message' => 'Your current password did not match. Please try again.',
                'alert-type' => 'error',
            );
            session()->flash('error_msg', 'Current password is incorrect.');
        }

        return redirect()->back()->with($toastr);
    }
}
