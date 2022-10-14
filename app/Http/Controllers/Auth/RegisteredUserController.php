<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AuditLog;
use App\Models\CharitableOrganization;
use App\Models\User;
use App\Models\UserInfo;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        # Validate Form Before Creating Records
        $request->validate(
            [
                /*
                |--------------------------------------------------------------------------
                | First Name, Middle Name, Last Name, Work Position
                |--------------------------------------------------------------------------
                |
                | First, Middle, and Last name must be alphabets only.
                | Only these non-special characters are allowed:
                | Space, enye(ñ), comma, dash, period, and single quote.
                |
                */

                # Full Name
                'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],

                # Contact and Occupation
                'cel_no' => ['required', 'regex:/(09)[0-9]{9}/', 'unique:user_infos'], // 09 + (Any 9-digit number from 1-9) - unique won't work since it is encrypted
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

                # Login Details
                'name' => ['required', 'string', 'min:3', 'max:128', 'unique:charitable_organizations'], // Name of their Charitable Organization.
                // 'profile_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],
                'username' => ['required', 'alpha_dash', 'string', 'min:6', 'max:20', 'unique:users'],
                'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', 'max:20', Rules\Password::defaults()],
                'is_agreed' => ['required'],
            ],
            [
                # Custom Error Messages
                'name.unique' => 'The charitable organization\'s name has already been registered.',
                'first_name.regex' => 'The first name field must not include number/s.',
                'middle_name.regex' => 'The middle name field must not include number/s.',
                'work_position.regex' => 'Work position must not include number(s) or must be a valid format.',
                'last_name.regex' => 'The last name field must not include number/s.',
                'cel_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
                'tel_no.regex' => 'The tel no format must be followed. Ex. 82531234',
                'is_agreed.required' => 'You must first agree before submitting.',
            ]
        );


        // BEGIN CREATING RECORDS TO THE DATABASE


        # Create New Charitable Organization Record
        $charity = new CharitableOrganization;
        $charity->code = Str::uuid()->toString();
        $charity->name = $request->name;
        $charity->status_updated_at = null;
        $charity->save();


        # Create New Address Record
        $address = new Address;
        $address->type = 'Present';
        $address->address_line_one = $request->address_line_one;
        $address->address_line_two = $request->address_line_two;
        $address->region = $request->region;
        $address->province = $request->province;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->barangay = $request->barangay;
        $address->save();


        # Create a New User Record
        $user = new User;
        $user->code = Str::uuid()->toString();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'Charity Admin';
        $user->charitable_organization_id = $charity->id;
        $user->status = 'Pending';
        $user->save();


        # Create a New User Info Record
        $user_info = new UserInfo;
        $user_info->user_id = $user->id;
        $user_info->first_name = $request->first_name;
        $user_info->middle_name = $request->middle_name;
        $user_info->last_name = $request->last_name;
        $user_info->cel_no = $request->cel_no;
        $user_info->tel_no = $request->tel_no;
        $user_info->work_position = $request->work_position;


        # Auto-generate an organizational_id_no if it was not provided in the form
        if (!$request->organizational_id_no) {
            $user_info->organizational_id_no = $this->generateIdNo();
        } else {
            $user_info->organizational_id_no = $request->organizational_id_no;
        }


        # Create an empty profile_requirements table
        // TO ADD


        # Create User Info Record (Continued)
        $user_info->address_id = $address->id;
        $user_info->updated_at = Carbon::now();
        $user_info->save();


        # Create a New Event (registration) where an email verification will be sent.
        event(new Registered($user));


        # Automatically Logs in the user
        Auth::login($user);


        # Create New Audit Logs for Creation of Charity and User Account
        $log_charity = new AuditLog;
        $log_charity->user_id = $user->id;
        $log_charity->action_type = 'REGISTER';
        $log_charity->charitable_organization_id = $user->charitable_organization_id;
        $log_charity->table_name = 'Charitable Organizations, UserInfo, User, Address';
        $log_charity->record_id = $user->code;
        $log_charity->action = $user->role . ' has successfully registered their account to their Charitable Organization named [' . $charity->name . '].';
        $log_charity->performed_at = Carbon::now();
        $log_charity->save();


        # Redirect to Home (Charity Dashboard Page)
        return redirect(RouteServiceProvider::HOME);
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
}
