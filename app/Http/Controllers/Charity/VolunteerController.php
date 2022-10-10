<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use App\Models\Volunteer;
use App\Models\Address;
use App\Models\AuditLog;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use App\Exports\Volunteers;
use Maatwebsite\Excel\Facades\Excel;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::where('charitable_organization_id', Auth::user()->charitable_organization_id)->latest()->get();
        return view('charity.main.volunteers.all', compact('volunteers'));
    }

    public function show($id)
    {
        $volunteer = Volunteer::where('id', $id)->orWhere('code', $id)->firstOrFail();

        # Users can only access their own charity's records
        if ($volunteer->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            return view('charity.main.volunteers.view', compact('volunteer'));
        }
    }

    public function create()
    {
        return view('charity.main.volunteers.add');
    }

    public function store(Request $request)
    {
        # Validation of New Volunteer
        $request->validate(
            [
                # Profile Picture
                'profile_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],

                # Personal Information
                'email' => ['required', 'email:rfc,dns'],
                'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'middle_name' => ['nullable', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'cel_no' => ['nullable', 'regex:/(09)[0-9]{9}/'], // 09 + (Any 9-digit number from 1-9),
                'tel_no' => ['nullable', 'regex:/(8)[0-9]{7}/'], // 8 + (Any 7-digit number from 1-9)

                'category' => ['nullable', 'string', 'min:1', 'max:64'],
                'label' => ['nullable', 'string', 'min:1', 'max:64'],

                # Address
                'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                'region' => ['required', 'string', 'min:3', 'max:64'],
                'province' => ['required', 'string', 'min:3', 'max:64'],
                'city' => ['required', 'string', 'min:3', 'max:64'],
                'barangay' => ['required', 'string', 'min:3', 'max:64'],
                'postal_code' => ['required', 'numeric', 'digits:4'],
            ],
            [
                # Custom Error Messages
                'profile_photo.max' => 'Your profile picture must not exceed the file size of 2mb.',
                'contact_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
                'tel_no.regex' => 'The tel no format must be followed. Ex. 82531234',
                'postal_code.digits' => 'The postal code must have 4 numbers.',

            ]
        );

        # Creating New Volunteer Address
        $volunteerAddress = new Address;
        $volunteerAddress->type = "Present";
        $volunteerAddress->address_line_one  = $request->address_line_one;
        $volunteerAddress->address_line_two = $request->address_line_two;
        $volunteerAddress->region = $request->region;
        $volunteerAddress->province = $request->province;
        $volunteerAddress->city = $request->city;
        $volunteerAddress->barangay = $request->barangay;
        $volunteerAddress->postal_code = $request->postal_code;
        $volunteerAddress->save();

        # Creating New Volunteer Record
        $volunteer = new Volunteer;
        $volunteer->code = Str::uuid()->toString();

        # Adding Profile Photo
        if ($request->file('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/charitable_org/volunteer_photos/'), $filename);
            $volunteer->profile_photo = $filename;
        }

        # Creating New Volunteer Record Cont.
        $volunteer->first_name = $request->first_name;
        $volunteer->last_name = $request->last_name;
        $volunteer->middle_name = $request->middle_name;
        $volunteer->email_address = $request->email;
        $volunteer->cel_no = $request->cel_no;
        $volunteer->tel_no = $request->tel_no;
        $volunteer->category = $request->category;
        $volunteer->label = $request->label;

        $volunteer->charitable_organization_id = Auth::user()->charitable_organization_id;
        $volunteer->address_id = $volunteerAddress->id;
        $volunteer->save();

        # Success toastr message
        $notification = array(
            'message' => 'A new volunteer record has been saved successfully!',
            'alert-type' => 'success',
        );

        # Audit Log
        AuditLog::create([
            'user_id' => Auth::id(),
            'action_type' => 'INSERT',
            'charitable_organization_id' => Auth::user()->charitable_organization_id,
            'table_name' => 'Volunteers',
            'record_id' => $volunteer->code,
            'action' => Auth::user()->role . ' added Volunteer named [ ' . $volunteer->first_name . ' ' . $volunteer->last_name . ' ].',
            'performed_at' => Carbon::now(),
        ]);

        return redirect()->route('charity.volunteers.all')->with($notification);
    }

    public function edit($id)
    {
        $volunteer = Volunteer::where('id', $id)->orWhere('code', $id)->firstOrFail();

        # Users can only access their own charity's records
        if ($volunteer->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            return view('charity.main.volunteers.edit', compact('volunteer'));
        }
    }

    public function update(Request $request, $id)
    {
        $volunteer = Volunteer::where('id', $id)->orWhere('code', $id)->firstOrFail();

        # Users can only access their own charity's records
        if ($volunteer->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            # Validation of Edit Volunteer
            $request->validate(
                [
                    # Profile Picture
                    'profile_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],

                    # Personal Information
                    'email' => ['required', 'email:rfc,dns'],
                    'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'middle_name' => ['nullable', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'cel_no' => ['nullable', 'regex:/(09)[0-9]{9}/'], // 09 + (Any 9-digit number from 1-9),
                    'tel_no' => ['nullable', 'regex:/(8)[0-9]{7}/'], // 8 + (Any 7-digit number from 1-9)

                    'category' => ['nullable', 'string', 'min:1', 'max:64'],
                    'label' => ['nullable', 'string', 'min:1', 'max:64'],

                    # Address
                    'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                    'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                    'region' => ['required', 'string', 'min:3', 'max:64'],
                    'province' => ['required', 'string', 'min:3', 'max:64'],
                    'city' => ['required', 'string', 'min:3', 'max:64'],
                    'barangay' => ['required', 'string', 'min:3', 'max:64'],
                    'postal_code' => ['required', 'numeric', 'digits:4'],
                ],
                [
                    # Custom Error Messages
                    'profile_photo.max' => 'Your profile picture must not exceed the file size of 2mb.',
                    'contact_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
                    'tel_no.regex' => 'The tel no format must be followed. Ex. 82531234',
                    'postal_code.digits' => 'The postal code must have 4 numbers.',

                ]
            );

            # Update Volunteer Profile Picture
            if ($request->file('profile_photo')) {

                # Delete old Profile Image if exists
                $oldImg = $volunteer->profile_photo;
                if ($oldImg) unlink(public_path('upload/charitable_org/volunteer_photos/') . $oldImg);

                # Replace with Uploaded New Profile Image
                $file = $request->file('profile_photo');
                $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/charitable_org/volunteer_photos/'), $filename);
                $volunteer->profile_photo = $filename;
                $volunteer->save();
            }

            # Begin Updating the Volunteer Record
            Volunteer::findOrFail($volunteer->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'email_address' => $request->email,
                'cel_no' => $request->cel_no,
                'tel_no' => $request->tel_no,

                'category' => $request->category,
                'label' => $request->label,

                'last_modified_by_id' => Auth::user()->id,
            ]);

            # Begin Updating the Permanent Address
            Address::findOrFail($volunteer->address_id)->update([
                'type' => "Present",
                'address_line_one' => $request->address_line_one,
                'address_line_two' => $request->address_line_two,
                'region' => $request->region,
                'province' => $request->province,
                'city' => $request->city,
                'barangay' => $request->barangay,
                'postal_code' => $request->postal_code,
            ]);

            #Toaster success message
            $notification = array(
                'message' => 'Volunteer record has been updated successfully!',
                'alert-type' => 'success',
            );

            # Audit Log
            AuditLog::create([
                'user_id' => Auth::id(),
                'action_type' => 'UPDATE',
                'charitable_organization_id' => Auth::user()->charitable_organization_id,
                'table_name' => 'Volunteers',
                'record_id' => $volunteer->code,
                'action' => Auth::user()->role . ' updated Volunteer [ ' . $volunteer->first_name . ' ' . $volunteer->last_name . ' ].',
                'performed_at' => Carbon::now(),
            ]);

            return redirect()->route('charity.volunteers.view', $volunteer->code)->with($notification);
        }
    }

    public function delete($id)
    {
        # Retrieve the volunteer record using Id
        $volunteer = Volunteer::where('id', $id)->orWhere('code', $id)->firstOrFail();
        $last_name = $volunteer->last_name;
        $first_name = $volunteer->first_name;
        $code = $volunteer->code;

        if ($volunteer->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only delete their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            # Delete the Profile Photo from the path
            $deletePhoto = $volunteer->profile_photo;
            if ($deletePhoto) unlink(public_path('upload/charitable_org/volunteer_photos/') . $deletePhoto);

            # Delete the volunteer
            $volunteer->delete();

            # Delete independent records
            Address::where('id', $volunteer->address_id)->delete();

            $notification = array(
                'message' => 'A volunteer record has been deleted successfully!',
                'alert-type' => 'success',
            );

            # Audit Log
            AuditLog::create([
                'user_id' => Auth::id(),
                'action_type' => 'DELETE',
                'charitable_organization_id' => Auth::user()->charitable_organization_id,
                'table_name' => 'Volunteers',
                'record_id' => $code,
                'action' => Auth::user()->role . ' deleted Volunteer [ ' . $first_name . ' ' . $last_name . ' ] permanently.',
                'performed_at' => Carbon::now(),
            ]);

            # Notification
            $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
            foreach ($users as $user) {
                Notification::create([
                    'code' => Str::uuid()->toString(),
                    'user_id' => $user->id,
                    'category' => 'Volunteer',
                    'Subject' => 'Deleted Volunteer',
                    'message' => 'The Volunteer Record of [ ' . $first_name . ' ' . $last_name . ' ] has been deleted by [ ' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name . ' ].',
                    'icon' => 'mdi mdi-account-remove',
                    'color' => 'danger',
                    'created_at' => Carbon::now(),
                ]);
            }

            return redirect()->route('charity.volunteers.all')->with($notification);
        }
    }

    public function BackupVolunteer()
    {
        $volunteers = Volunteer::where('charitable_organization_id', Auth::user()->charitable_organization_id)->get();

        # Check if atleast one volunteer exists before attempting to generate.
        if ($volunteers->count() < 1) {

            $notification = array(
                'message' => 'Sorry, cannot generate a backup unless one (1) or more volunteers exist.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        # Create Audit Logs
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'GENERATE EXCEL';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Volunteer';
        $log->record_id = null;
        $log->action = Auth::user()->role . ' generated Excel to backup all Volunteers in ' . Auth::user()->charity->name . '.';
        $log->performed_at = Carbon::now();
        $log->save();


        # Send Notification
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Volunteer';
            $notif->subject = 'Backup Volunteers';
            $notif->message = Auth::user()->role . ' [' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name .
                '] has attempted to back up a copy of Volunteers from [' . Auth::user()->charity->name . '] into an Excel File.';
            $notif->icon = 'mdi mdi-file-download';
            $notif->color = 'warning';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        return Excel::download(new Volunteers, Auth::user()->charity->name . ' - Volunteers (' . Carbon::now()->isoFormat('lll') . ').xlsx');
    }
}
