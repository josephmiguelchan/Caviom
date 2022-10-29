<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;
use App\Models\CharitableOrganization;
use App\Models\User;
use App\Models\Address;
use App\Models\Admin\FeaturedProject;
use App\Models\Admin\Notifier;
use App\Models\AuditLog;
use App\Models\Charity\Profile\ProfileRequirement;
use App\Models\Notification;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;


class CharitableOrganizationController extends Controller
{
    public function AllCharityOrganization()
    {
        $CharityOrganizations = CharitableOrganization::orderBy('name', 'ASC')->get();

        return view('admin.charities.all', compact('CharityOrganizations'));
    }
    public function ViewCharityOrganization($code)
    {
        # Retrieve the Organization detail
        $organizationdetail = CharitableOrganization::where('code', $code)->firstOrFail();

        # Get the count of Admins in the Organization
        $admins =  User::where('charitable_organization_id', $organizationdetail->id)->where('role', 'Charity Admin')->where('status', 'Active')->get();

        # Get the count of Associates in the Organization
        $countofAssociates =  User::where('charitable_organization_id', $organizationdetail->id)->where('role', 'Charity Associate')->where('status', 'Active')->count();

        # Get the count of Associates in the Organization
        $featuredProjectsCount = FeaturedProject::where('charitable_organization_id', $organizationdetail->id)->where('approval_status', 'Approved')->count();

        # Get the requirements submitted by their Charity Admin (If any)
        $requirements = ProfileRequirement::where('charitable_organization_id', $organizationdetail->id)->first();

        return view('admin.charities.view', compact('organizationdetail', 'admins', 'countofAssociates', 'featuredProjectsCount', 'requirements'));
    }


    public function SendNotification(Request $request, $id)
    {
        # Validation Rules
        $validator = Validator::make($request->all(), [
            'content_message' => 'required|min:5|max:350'
        ]);

        if ($validator->fails()) {
            $toastr = array(
                'message' => $validator->errors()->first() . '. Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        # Send Notification to each user in their Charitable Organizations
        $users = User::where('charitable_organization_id', $id)->where('status', 'Active')->get();

        foreach ($users as $user) {

            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Public Profile';
            $notif->subject = 'Message From Caviom';
            $notif->message = $request->content_message;
            $notif->icon = 'mdi mdi-message-flash';
            $notif->color = 'info';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        # Send Success toastr
        $toastr = array(
            'message' => ' Notification has been successfully send to active users of this Charitable Organization.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);
    }

    public function CharityProfileSetting(Request $request, $code)
    {

        # Retrieve the Organization detail
        $organization = CharitableOrganization::where('code', $code)->firstOrFail();

        # Prevent from updating profile settings if profile has not yet been setup.
        if ($organization->profile_status == 'Unset') {
            $toastr = array(
                'message' => 'Sorry, the public profile of this Organization must be setup first before it can be updated.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }

        $remarks = Notifier::where('category', 'Public Profile')->pluck('subject')->toArray();

        $request->validate([
            'visibility_status' => ['required', Rule::in(['Hidden', 'Visible', 'Locked'])],
            'verification_status' => ['required', Rule::in(['Verified', 'Declined'])],
            'remarks' => ['nullable', Rule::in($remarks)]
        ]);

        # Set the remarks MESSAGE based on the value of profile's remarks from Notifiers dropdown table.
        if ($request->remarks == null) {
            $organization->remarks_subject = null;
            $organization->remarks_message = null;
        } else {
            $organization->remarks_subject = $request->remarks;
            $remarks_from_notifiers = Notifier::where('category', 'Public Profile')->get();
            foreach ($remarks_from_notifiers as $notifier) {
                switch ($request->remarks) {
                    case $notifier->subject:
                        $organization->remarks_message = $notifier->message;
                        break;
                }
            }
        }

        $organization->profile_status = $request->visibility_status;
        $organization->verification_status = $request->verification_status;
        $organization->status_updated_at = Carbon::now();

        $organization->update();


        #Send notification
        $users = User::where('charitable_organization_id', $organization->id)->where('status', 'Active')->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Public Profile';
            $notif->subject = 'Profile Status Update';
            $notif->message = 'Caviom has received and reviewed your verification request.
             Your Charitable Organization Public Profile has been set to ' . str::upper($request->visibility_status) . '
             and its verification status as ' . str::upper($request->verification_status) . ' with remarks: [ ' . $request->remarks . ' ].';
            $notif->icon = 'mdi mdi-cog';
            $notif->color = 'info';
            $notif->created_at = Carbon::now();
            $notif->save();
        }


        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = $organization->id;
        $log_in->table_name = 'Charitable Organization';
        $log_in->record_id = $organization->code;
        $log_in->action = Auth::user()->role . ' updated the User Visibility_status , Verification_status and Remarks For [' . $organization->name . '].';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        # Send Success toastr
        $toastr = array(
            'message' => ' The Charity Public Profile Settings has been succesfully updated.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);
    }

    public function ViewCharityUserDetail($code)
    {
        $User = User::where('code', $code)->firstOrFail();

        return view('admin.charities.users.view', compact('User'));
    }

    public function EditCharityUserDetail($code)
    {
        $User = User::where('code', $code)->firstOrFail();

        return view('admin.charities.users.edit', compact('User'));
    }

    public function UpdateCharityUserDetail(Request $request, $code)
    {
        # Retrieve the select  user record
        $User = User::where('code', $code)->firstOrFail();

        # Validation of Form
        $request->validate([

            # For Account fields
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255',  Rule::unique('users')->ignore($User)],
            // 'username' => ['required_unless:account_status,Pending Unlock'],

            # For Personal Information
            'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'work_position' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'cel_no' => ['required', 'regex:/(09)[0-9]{9}/'],
            'tel_no' => ['nullable', 'regex:/(8)[0-9]{7}/'],

            # Current Address
            'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
            'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
            'region' => ['required', 'string', 'min:3', 'max:64'],
            'province' => ['required', 'string', 'min:3', 'max:64'],
            'city' => ['required', 'string', 'min:3', 'max:64'],
            'barangay' => ['required', 'string', 'min:3', 'max:64'],
            'postal_code' =>  ['required', 'integer', 'digits:4'],
        ], [

            'first_name.regex' => 'The first name field must not include number/s.',
            'middle_name.regex' => 'The middle name field must not include number/s.',
            'work_position.regex' => 'Work position must not include number(s) or must be a valid format.',
            'last_name.regex' => 'The last name field must not include number/s.',
            'cel_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
            'tel_no.regex' => 'The tel no format must be followed. Ex. 82531234',
        ]);

        # Update Record
        $User->email = $request->email;
        $User->username = $request->username;

        # If New Password field has value
        if ($request->password) {
            $request->validate([
                'password' => ['max:20', Rules\Password::defaults()],
                'confirm_password' => ['nullable', 'same:password'],
            ]);
            $User->password = Hash::make($request->password);
        }

        # Make the username field as nullable as long as the account status is Pending Unlock.
        if ($request->username) {
            $request->validate([
                'username' => ['alpha_dash', 'string', 'min:6', 'max:20',  Rule::unique('users')->ignore($User)],
            ]);
            $User->username = $request->username;
        }

        # Set the remarks MESSAGE based on the value of user's remarks from Notifiers table.
        if ($request->remarks == null) {
            $User->remarks = null;
            $User->remarks_message = null;
        } else {
            $User->remarks = $request->remarks;
            $account_remarks_from_notifiers = Notifier::where('category', 'Charity User')->get();
            foreach ($account_remarks_from_notifiers as $value) {
                switch ($request->remarks) {
                    case $value->subject:
                        $User->remarks_message = $value->message;
                        break;
                }
            }
        }

        # Continue Updating User
        $User->updated_at =  Carbon::now();
        $User->status = $request->account_status;
        $User->update();

        $UserInfo = UserInfo::findOrFail($User->info->id);
        $UserInfo->first_name = $request->first_name;
        $UserInfo->middle_name = $request->middle_name;
        $UserInfo->last_name = $request->last_name;
        $UserInfo->work_position = $request->work_position;
        $UserInfo->tel_no = $request->tel_no;
        $UserInfo->cel_no = $request->cel_no;
        $UserInfo->update();

        $address = Address::findOrFail($User->info->address_id);
        $address->address_line_one = $request->address_line_one;
        $address->address_line_two = $request->address_line_two;
        $address->region = $request->region;
        $address->province = $request->province;
        $address->city = $request->city;
        $address->barangay = $request->barangay;
        $address->postal_code = $request->postal_code;
        $address->updated_at = Carbon::now();
        $address->update();

        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id =  null;
        $log_in->table_name = 'User, User Info, Address';
        $log_in->record_id = $User->code;
        $log_in->action = Auth::user()->role . ' updated the User profile of [ ' . $User->username . ' ] with ID: ' . $User->code;
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        # Send notification to the user who the root admin edited
        $notif = new Notification;
        $notif->code = Str::uuid()->toString();
        $notif->user_id = $User->id;
        $notif->category = 'Charity User';
        $notif->subject = 'Updated User Profile';
        $notif->message =  'Caviom has updated your User Profile. Kindly check your profile for updated information.';
        $notif->icon = 'mdi mdi-account-cog';
        $notif->color = 'warning';
        $notif->created_at = Carbon::now();
        $notif->save();



        # Send Success toastr
        $toastr = array(
            'message' => 'User Profile has been successfully Updated.',
            'alert-type' => 'success'
        );

        return to_route('admin.charities.users.view', $code)->with($toastr);
    }


    public function CharityFeaturedProject()
    {
    }
}
