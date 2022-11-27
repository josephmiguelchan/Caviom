<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AuditLog;
use App\Models\CharitableOrganization;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function allAdminUsers()
    {
        $Users = User::where('role', 'Root Admin')->latest()->get();

        return view('admin.main.users.all', compact('Users'));
    }
    public function viewAdminUser($code)
    {
        $User = User::where('code', $code)->firstOrFail();
        return view('admin.main.users.view', compact('User'));
    }
    public function addAdminUser()
    {
        return view('admin.main.users.add');
    }
    public function storeAdminUser(Request $request)
    {
        # Validation of Form
        $request->validate([

            # For user table fields
            'profile_image' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'username' => ['required', 'alpha_dash', 'string', 'min:6', 'max:20', 'unique:users'],
            'password' => ['required', 'max:20', Rules\Password::defaults()],
            'confirm_password' => ['required', 'same:password'],

            # For user info table fields
            'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'work_position' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
            'cel_no' => ['required', 'regex:/(63)\s[0-9]{3}\s[0-9]{3}\s[0-9]{4}/', 'unique:user_infos'], // Unique won't work since it is encrypted
            'tel_no' => ['nullable', 'regex:/(632)\s(8)[0-9]{3}\s[0-9]{4}/'],

            # For address table fields
            'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
            'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
            'region' => ['required', 'string', 'min:3', 'max:64'],
            'province' => ['required', 'string', 'min:3', 'max:64'],
            'city' => ['required', 'string', 'min:3', 'max:64'],
            'barangay' => ['required', 'string', 'min:3', 'max:64'],
            'postal_code' =>  ['required', 'integer', 'digits:4'],

        ], [
            'profile_image.max' => 'Your profile picture must not exceed the file size of 2mb.',
            'first_name.regex' => 'The first name field must not include number/s.',
            'middle_name.regex' => 'The middle name field must not include number/s.',
            'work_position.regex' => 'Work position must not include number(s) or must be a valid format.',
            'last_name.regex' => 'The last name field must not include number/s.',
            'cel_no.regex' => 'The cel no format must be followed. Ex. +63 998 123 4567',
            'tel_no.regex' => 'The tel no format must be followed. Ex. +632 8123 6789',
        ]);

        # Store Data to address table
        $address = new Address;
        $address->type = 'Present';
        $address->address_line_one = $request->address_line_one;
        $address->address_line_two = $request->address_line_two;
        $address->region = $request->region;
        $address->province = $request->province;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->barangay = $request->barangay;
        $address->created_at = Carbon::now();
        $address->save();

        # Store Data to users table
        $user = new User;
        $user->code = Str::uuid()->toString();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = 'Root Admin';
        $user->charitable_organization_id = null;
        $user->status = 'Pending Unlock';
        $user->created_at = Carbon::now();
        $user->save();

        # Insert Profile Picture
        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/avatar_img/'), $filename);
            $user->profile_image = $filename;
        }

        # Store Data to User Infos table
        $user_info = new UserInfo;
        $user_info->user_id = $user->id;
        $user_info->first_name = $request->first_name;
        $user_info->middle_name = $request->middle_name;
        $user_info->last_name = $request->last_name;
        $user_info->cel_no = $request->cel_no;
        $user_info->tel_no = $request->tel_no;
        $user_info->work_position = $request->work_position;
        $user_info->organizational_id_no = $user_info->organizational_id_no = $this->generateIdNo();;
        $user_info->address_id = $address->id;
        $user_info->updated_at = Carbon::now();
        $user_info->save();

        # Create a New Event (registration) where an email verification will be sent.
        // event(new Registered($user));

        # Create Audit Logs
        $log = new AuditLog();
        $log->user_id = Auth::user()->id;
        $log->action_type = 'ADDED ROOT ADMIN';
        $log->charitable_organization_id = null;
        $log->table_name = 'User, UserInfo, Address';
        $log->record_id = $user->code;
        $log->action = 'Root Admin added [' . $request->first_name . ' ' . $request->last_name . '] as new Root Admin.';
        $log->performed_at = Carbon::now();
        $log->save();

        # Success Toastr Message display
        $notification = array(
            'message' => 'Pending Root Admin added successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users')->with($notification);
    }
    private function generateIdNo()
    {
        $id_no_exist = true;
        $id_no = null;
        while ($id_no_exist) {
            $id_no = Carbon::now()->format('Y') . substr(hexdec(uniqid()), 0, 6);   // ID No. = Current year (YYYY) + Random 6 numbers
            $user_found = UserInfo::where('organizational_id_no', $id_no)->first(); // Generated ID No. must not yet exist in the DB
            if (!$user_found) {
                return $id_no;
                $id_no_exist = false; // Ends the loop if the Generated ID No. is already unique.
            }
        }
    }
    public function viewCharityUser($code)
    {
        $User = User::where('code', $code)->firstOrFail();

        return view('admin.charities.users.view', compact('User'));
    }
    public function editCharityUser($code)
    {
        $User = User::where('code', $code)->firstOrFail();

        return view('admin.charities.users.edit', compact('User'));
    }
}
