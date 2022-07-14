<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
        // Validate Form First
        $request->validate(
            [
                # Personal Details
                'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ]*$/'],
                'middle_name' => ['nullable', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ]*$/'],
                'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ]*$/'],
                'cel_no' => ['required', 'regex:/(09)[0-9]{9}/'],
                'tel_no' => ['nullable', 'regex:/(8)[0-9]{7}/'],
                'work_position' => ['required', 'string', 'min:4', 'max:64'],
                'organizational_id_no' => ['nullable', 'integer', 'numeric', 'min:100', 'max:9999999999'], // To modify: 'unique:user_infos'

                # Current address
                'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                'province' => ['required', 'string', 'min:3', 'max:64'],
                'city' => ['required', 'string', 'min:3', 'max:64'],
                'barangay' => ['required', 'string', 'min:3', 'max:64'],
                'postal_code' => ['required', 'string', 'min:4', 'max:10'],

                # Login Details
                'name' => ['required', 'string', 'min:3', 'max:128'], // To add: 'unique:charitable_organizations'
                'profile_image' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],
                'username' => ['required', 'alpha_dash', 'string', 'max:20', 'unique:users'],
                'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', 'max:20', Rules\Password::defaults()],
                'is_agreed' => ['required'],
            ],
            [
                'first_name.regex' => 'The first name field must not include number/s.',
                'middle_name.regex' => 'The middle name field must not include number/s.',
                'last_name.regex' => 'The last name field must not include number/s.',
                'cel_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
                'tel_no.regex' => 'The tel no format must be followed. Ex. 82531234',
                'is_agreed.required' => 'You must first agree before submitting',
            ]
        );

        # Create New Charitable Organization Record



        # Create New Address Record



        # Create a New User Record
        $user = new User;
        // $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'Charity Admin';
        $user->status = 'Pending';
        $user->save();

        # Create a New Event (registration)
        event(new Registered($user));

        # Automatically Logs in the user
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
