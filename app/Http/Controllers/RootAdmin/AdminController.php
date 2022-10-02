<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AuditLog;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Returns the Login page for Admins
    public function adminLogin()
    {
        # If user is already authenticated, no need to return to the login admin page.
        if (Auth::user()) {
            if (Auth::user()->role == "Root Admin") {
                return to_route('admin.panel');
            } else {
                return to_route('dashboard');
            }
        }
        return view('admin.auth.login');
    }

    // Show the Admin Panel home page
    public function showAdminPanel()
    {
        return view('admin.index');
    }

    // Logout Admin
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        # Create Audit Log for Login
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'LOGIN';
        $log_in->charitable_organization_id = null;
        $log_in->table_name = null;
        $log_in->record_id = null;
        $log_in->action = Auth::user()->role . ' has successfully logged in on ' . Carbon::now()->toDayDateTimeString() . ' using Client IP Address: ' .
            $request->ip();
        $log_in->performed_at = Carbon::now();
        $log_in->save();


        return redirect('/login');
    }

    // Show User Profile
    public function showProfile()
    {
        return view('admin.user.profile');
    }

    // Redirect to Edit Profile Page
    public function editProfile()
    {
        return view('admin.user.edit');
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
                'cel_no' => ['required', 'regex:/(09)[0-9]{9}/'], // 09 + (Any 9-digit number from 1-9)
                'tel_no' => ['nullable', 'regex:/(8)[0-9]{7}/'], // 8 + (Any 7-digit number from 1-9)
                'work_position' => ['required', 'string', 'min:4', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'organizational_id_no' => ['nullable', 'integer', 'numeric', 'min:100', 'max:9999999999', 'unique:user_infos'], // !! Must be unique only to their charitable organization only.

                # Current address
                'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                'province' => ['required', 'string', 'min:3', 'max:64'],
                'city' => ['required', 'string', 'min:3', 'max:64'],
                'barangay' => ['required', 'string', 'min:3', 'max:64'],
                'postal_code' => ['required', 'string', 'min:4', 'max:10'],
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
        $notification = array(
            'message' => 'Profile has been saved successfully!',
            'alert-type' => 'success',
        );

        return to_route('admin.profile')->with($notification);
    }

    // Change User Password
    public function editPassword()
    {
        return view('admin.user.password');
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


            # Create Audit Logs Record
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
            $notification = array(
                'message' => 'Password has been updated successfully!',
                'alert-type' => 'success',
            );
        } else {

            # Throws an error message if current password did not match
            $notification = array(
                'message' => 'Your current password did not match. Please try again.',
                'alert-type' => 'error',
            );
            session()->flash('error_msg', 'Current password is incorrect.');
        }

        return redirect()->back()->with($notification);
    }
}
