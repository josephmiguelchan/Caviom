<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\BeneficiaryFamilyInfo;
use App\Models\BeneficiaryBgInfo;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class BeneficiaryController extends Controller
{

    public function index()
    {
        $beneficiaries = Beneficiary::where('charitable_organization_id', Auth::user()->charitable_organization_id)->get();
        return view('charity.main.beneficiaries.all', compact('beneficiaries'));
    }

    public function create()
    {
        return view('charity.main.beneficiaries.add');
    }

    public function store(Request $request)
    {

        # Validation of New Beneficiary (excluding addresses)
        $request->validate(
            [
                # Profile Picture
                'profile_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],

                # Personal Information
                'nick_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'interviewed_at' => ['nullable', 'after:' . now()->subYears(100)],
                'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'birth_date' => ['required', 'before:' . now()->toDateString(), 'after:' . now()->subYears(100)],
                'birth_place' => ['nullable', 'string', 'min:1', 'max:64'],
                'religion' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'educational_attainment' => ['nullable', 'string', 'min:1', 'max:64'],
                'last_school_year_attended' => ['nullable', 'string', 'min:1', 'max:64'],
                'contact_no' => ['nullable', 'regex:/(09)[0-9]{9}/'], // 09 + (Any 9-digit number from 1-9)

                # Permanent Address
                'permanent_address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                'permanent_address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                'permanent_region' => ['required', 'string', 'min:3', 'max:64'],
                'permanent_province' => ['required', 'string', 'min:3', 'max:64'],
                'permanent_city' => ['nullable', 'string', 'min:3', 'max:64'],
                'permanent_barangay' => ['nullable', 'string', 'min:3', 'max:64'],
                'permanent_postal_code' => ['required', 'numeric', 'digits:4'],
            ],
            [
                # Custom Error Messages
                'profile_photo.max' => 'Your profile picture must not exceed the file size of 2mb.',
                'first_name.regex' => 'The first name field must not include number/s.',
                'last_name.regex' => 'The last name field must not include number/s.',
                'middle_name.regex' => 'The middle name field must not include number/s.',
                'birth_date.before' => 'The age must be realistic.',
                'contact_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
                'permanent_postal_code.digits' => 'The postal code must have 4 numbers.',
            ]
        );

        # Sending the Value of Same As Present Address Checkbox
        if (!$request->has('use_permanent_address')) {
            $checkbox1 = 0;
        } else {
            $checkbox1 = 1;
        };

        # Sending the Value of No Provincial Address Checkbox
        if (!$request->has('no_provincial_address')) {
            $checkbox2 = 0;
        } else {
            $checkbox2 = 1;
        };

        # Validation and Creating New Present Address
        if ($checkbox1 == 0) {
            $request->validate([
                #Present Address
                'present_address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                'present_address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                'present_region' => ['required', 'string', 'min:3', 'max:64'],
                'present_province' => ['required', 'string', 'min:3', 'max:64'],
                'present_city' => ['nullable', 'string', 'min:3', 'max:64'],
                'present_barangay' => ['nullable', 'string', 'min:3', 'max:64'],
                'present_postal_code' => ['required', 'numeric', 'digits:4'],
            ], [
                #Custom Error Message
                'provincial_postal_code.digits' => 'The postal code must have 4 numbers.',
            ]);

            # Creating New Present Address
            $presentAddress = new Address;
            $presentAddress->type = "Present";
            $presentAddress->address_line_one  = $request->present_address_line_one;
            $presentAddress->address_line_two = $request->present_address_line_two;
            $presentAddress->region = $request->present_region;
            $presentAddress->province = $request->present_province;
            $presentAddress->city = $request->present_city;
            $presentAddress->barangay = $request->present_barangay;
            $presentAddress->postal_code = $request->present_postal_code;
            $presentAddress->save();
        } else {

            # Creating New Present Address with Permanent Address as its values
            $presentAddress = new Address;
            $presentAddress->type = "Present";
            $presentAddress->address_line_one  = $request->permanent_address_line_one;
            $presentAddress->address_line_two = $request->permanent_address_line_two;
            $presentAddress->region = $request->permanent_region;
            $presentAddress->province = $request->permanent_province;
            $presentAddress->city = $request->permanent_city;
            $presentAddress->barangay = $request->permanent_barangay;
            $presentAddress->postal_code = $request->permanent_postal_code;
            $presentAddress->save();
        };

        # Validation and Creating New Provincial Address
        if ($checkbox2 == 1) {
            # Creating New Provincial Address Without Values
            $provincialAddress = new Address;
            $provincialAddress->type = "Provincial";
            $provincialAddress->address_line_one  = "";
            $provincialAddress->address_line_two = "";
            $provincialAddress->region = "";
            $provincialAddress->province = "";
            $provincialAddress->city = "";
            $provincialAddress->barangay = "";
            $provincialAddress->postal_code = "";
            $provincialAddress->save();
        } else {
            $request->validate([
                #Provincial Address
                'provincial_address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                'provincial_address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                'provincial_region' => ['required', 'string', 'min:3', 'max:128'],
                'provincial_province' => ['required', 'string', 'min:3', 'max:128'],
                'provincial_city' => ['nullable', 'string', 'min:3', 'max:64'],
                'provincial_barangay' => ['nullable', 'string', 'min:3', 'max:64'],
                'provincial_postal_code' => ['required', 'numeric', 'digits:4'],
            ], [
                #Custom Error Message
                'provincial_postal_code.digits' => 'The postal code must have 4 numbers.',
            ]);

            # Creating New Provincial Address
            $provincialAddress = new Address;
            $provincialAddress->type = "Provincial";
            $provincialAddress->address_line_one  = $request->provincial_address_line_one;
            $provincialAddress->address_line_two = $request->provincial_address_line_two;
            $provincialAddress->region = $request->provincial_region;
            $provincialAddress->province = $request->provincial_province;
            $provincialAddress->city = $request->provincial_city;
            $provincialAddress->barangay = $request->provincial_barangay;
            $provincialAddress->postal_code = $request->provincial_postal_code;
            $provincialAddress->save();
        };

        # Creating New Permanent Address
        $permanentAddress = new Address;
        $permanentAddress->type = "Permanent";
        $permanentAddress->address_line_one  = $request->permanent_address_line_one;
        $permanentAddress->address_line_two = $request->permanent_address_line_two;
        $permanentAddress->region = $request->permanent_region;
        $permanentAddress->province = $request->permanent_province;
        $permanentAddress->city = $request->permanent_city;
        $permanentAddress->barangay = $request->permanent_barangay;
        $permanentAddress->postal_code = $request->permanent_postal_code;
        $permanentAddress->save();

        # Creating New Beneficiary Record Part 1 - Basic Info
        $beneficiary = new Beneficiary;
        $beneficiary->code = Str::uuid()->toString();
        $beneficiary->nick_name = $request->nick_name;

        # Adding Profile Photo
        if ($request->file('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/charitable_org/beneficiary_photos/'), $filename);
            $beneficiary->profile_photo = $filename;
        }

        # Create New Beneficiary Record Part 1 - Basic Info Cont'
        $beneficiary->first_name = $request->first_name;
        $beneficiary->last_name = $request->last_name;
        $beneficiary->middle_name = $request->middle_name;
        $beneficiary->birth_date = $request->birth_date;
        $beneficiary->birth_place = $request->birth_place;
        $beneficiary->religion = $request->religion;
        $beneficiary->educational_attainment = $request->educational_attainment;
        $beneficiary->last_school_year_attended = $request->last_school_year_attended;
        $beneficiary->interviewed_at = $request->interviewed_at;
        $beneficiary->contact_no = $request->contact_no;
        $beneficiary->prepared_by = $request->prepared_by;
        $beneficiary->noted_by = $request->noted_by;
        $beneficiary->category = $request->category;
        $beneficiary->label = $request->label;

        $beneficiary->charitable_organization_id = Auth::user()->charitable_organization_id;
        $beneficiary->permanent_address_id = $permanentAddress->id;
        $beneficiary->present_address_id = $presentAddress->id;
        $beneficiary->provincial_address_id = $provincialAddress->id;
        $beneficiary->last_modified_by_id = Auth::user()->id;
        $beneficiary->save();

        # Create New Beneficiary Background Information
        $beneficiaryBgInfo = new BeneficiaryBgInfo;
        $beneficiaryBgInfo->problem_presented = "---";
        $beneficiaryBgInfo->about_client = "---";
        $beneficiaryBgInfo->about_family = "---";
        $beneficiaryBgInfo->about_community = "---";
        $beneficiaryBgInfo->assessment = "---";
        $beneficiaryBgInfo->beneficiary_id = $beneficiary->id;
        $beneficiaryBgInfo->save();

        # Create Audit Logs
        //TO DO --- Not sure if this will work.
        //            $uuid = Str::uuid()->toString();
        //
        //            $log = new AuditLog;
        //            $log->user_id = Auth::user()->id;
        //            $log->action_type = 'ADD';
        //            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        //            $log->table_name = 'Beneficiaries';
        //            $log->record_id = $uuid;
        //            $log->action = 'Charity User added beneficiary [' . $request->last_name . ', '. $request->first_name . ' ' . $request->middle_name . ']';
        //            $log->performed_at = Carbon::now();
        //            $log->save();

        # Send Notification to each user in their Charitable Organizations
        //            $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
        //
        //            foreach ($users as $user) {
        //                Notification::insert([
        //                    'code' => Str::uuid()->toString(),
        //                    'user_id' => $user->id,
        //                    'category' => 'Beneficiary',
        //                    'Subject' => 'Beneficiary Record Added',
        //                    'message' => 'The Beneficiary Record of '. $beneficiaryDelete->last_name . ', ' . $beneficiaryDelete->first_name . ', ' . $beneficiaryDelete->middle_name .
        //                        ' has been added by [' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name . ']',
        //                    'icon' => 'mdi mdi-account-remove',
        //                    'color' => 'success',
        //                    'created_at' => Carbon::now(),
        //                ]);
        //            }


        return redirect()->route('charity.beneficiaries2.createPart2', $beneficiary->code);
    }

    public function show($id)
    {
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstOrFail();

        # Users can only access their own charity's records
        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $presentAddress = Address::where('id', $beneficiary->present_address_id)->firstOrFail();
            $permanentAddress = Address::where('id', $beneficiary->permanent_address_id)->firstOrFail();
            $provincialAddress = Address::where('id', $beneficiary->provincial_address_id)->firstOrFail();
            $lastModifiedBy = User::with('info')->where('id', $beneficiary->last_modified_by_id)->firstOrFail();
            $bgInfo = BeneficiaryBgInfo::where('beneficiary_id', $beneficiary->id)->firstOrFail();

            return view('charity.main.beneficiaries.view', compact(
                'beneficiary',
                'presentAddress',
                'permanentAddress',
                'provincialAddress',
                'lastModifiedBy',
                'bgInfo'
            ));
        };
    }

    public function edit($id)
    {
        $beneficiaryEdit = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();

        if (!$beneficiaryEdit->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $presentAddressEdit = Address::where('id', $beneficiaryEdit->present_address_id)->firstorFail();
            $permanentAddressEdit = Address::where('id', $beneficiaryEdit->permanent_address_id)->firstorFail();
            $provincialAddressEdit = Address::where('id', $beneficiaryEdit->provincial_address_id)->firstorFail();

            return view('charity.main.beneficiaries.edit', compact(
                'beneficiaryEdit',
                'presentAddressEdit',
                'permanentAddressEdit',
                'provincialAddressEdit'
            ));
        }
    }

    public function update(Request $request, $id)
    {

        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstOrFail();

        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            # Validation of Edit Beneficiary (excluding addresses)
            $request->validate(
                [
                    # Profile Picture
                    'profile_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],

                    # Personal Information
                    'nick_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'interviewed_at' => ['nullable', 'after:' . now()->subYears(100)],
                    'first_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'last_name' => ['required', 'string', 'min:2', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'birth_date' => ['required', 'before:' . now()->toDateString(), 'after:' . now()->subYears(100)],
                    'birth_place' => ['nullable', 'string', 'min:1', 'max:64'],
                    'religion' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                    'educational_attainment' => ['nullable', 'string', 'min:1', 'max:64'],
                    'last_school_year_attended' => ['nullable', 'string', 'min:1', 'max:64'],
                    'contact_no' => ['nullable', 'regex:/(09)[0-9]{9}/'], // 09 + (Any 9-digit number from 1-9)

                    # Permanent Address
                    'permanent_address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                    'permanent_address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                    'permanent_region' => ['required', 'string', 'min:3', 'max:64'],
                    'permanent_province' => ['required', 'string', 'min:3', 'max:64'],
                    'permanent_city' => ['nullable', 'string', 'min:3', 'max:64'],
                    'permanent_barangay' => ['nullable', 'string', 'min:3', 'max:64'],
                    'permanent_postal_code' => ['required', 'numeric', 'digits:4'],
                ],
                [
                    # Custom Error Messages
                    'profile_photo.max' => 'Your profile picture must not exceed the file size of 2mb.',
                    'first_name.regex' => 'The first name field must not include number/s.',
                    'last_name.regex' => 'The last name field must not include number/s.',
                    'middle_name.regex' => 'The middle name field must not include number/s.',
                    'birth_date.before' => 'The age must be realistic.',
                    'contact_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
                    'permanent_postal_code.digits' => 'The postal code must have 4 numbers.',
                ]
            );

            # Update Beneficiary Profile Picture
            if ($request->file('profile_photo')) {

                # Delete old Profile Image if exists
                $oldImg = $beneficiary->profile_photo;
                if ($oldImg) unlink(public_path('upload/charitable_org/beneficiary_photos/') . $oldImg);

                # Replace with Uploaded New Profile Image
                $file = $request->file('profile_photo');
                $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/charitable_org/beneficiary_photos/'), $filename);
                $beneficiary->profile_photo = $filename;
                $beneficiary->save();
            }

            # Begin Updating the Beneficiary Record Part 1 - Basic Info
            Beneficiary::findOrFail($beneficiary->id)->update([
                'nick_name' => $request->nick_name,
                'interviewed_at' => $request->interviewed_at,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'religion' => $request->religion,
                'educational_attainment' => $request->educational_attainment,
                'last_school_year_attended' => $request->last_school_year_attended,
                'contact_no' => $request->contact_no,
                'prepared_by' => $request->prepared_by,
                'noted_by' => $request->noted_by,
                'category' => $request->category,
                'label' => $request->label,
                'last_modified_by_id' => Auth::user()->id,
            ]);

            # Begin Updating the Permanent Address
            Address::findOrFail($beneficiary->permanent_address_id)->update([
                'type' => "Permanent",
                'address_line_one' => $request->permanent_address_line_one,
                'address_line_two' => $request->permanent_address_line_two,
                'region' => $request->permanent_region,
                'province' => $request->permanent_province,
                'city' => $request->permanent_city,
                'barangay' => $request->permanent_barangay,
                'postal_code' => $request->permanent_postal_code,
            ]);


            # Sending the Value of Same As Present Address Checkbox
            if (!$request->has('use_permanent_address')) {
                $checkbox1 = 0;
            } else {
                $checkbox1 = 1;
            };

            # Sending the Value of No Provincial Address Checkbox
            if (!$request->has('no_provincial_address')) {
                $checkbox2 = 0;
            } else {
                $checkbox2 = 1;
            };

            # Validation and Creating New Present Address
            if ($checkbox1 == 0) {
                $request->validate([
                    #Present Address
                    'present_address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                    'present_address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                    'present_region' => ['required', 'string', 'min:3', 'max:64'],
                    'present_province' => ['required', 'string', 'min:3', 'max:64'],
                    'present_city' => ['nullable', 'string', 'min:3', 'max:64'],
                    'present_barangay' => ['nullable', 'string', 'min:3', 'max:64'],
                    'present_postal_code' => ['required', 'numeric', 'digits:4'],
                ], [
                    #Custom Error Message
                    'provincial_postal_code.digits' => 'The postal code must have 4 numbers.',
                ]);

                # Begin Updating the Present Address
                Address::findOrFail($beneficiary->present_address_id)->update([
                    'type' => "Present",
                    'address_line_one' => $request->present_address_line_one,
                    'address_line_two' => $request->present_address_line_two,
                    'region' => $request->present_region,
                    'province' => $request->present_province,
                    'city' => $request->present_city,
                    'barangay' => $request->present_barangay,
                    'postal_code' => $request->present_postal_code,
                ]);
            } else {

                # Begin Updating the Present Address with Permanent Address as its values
                Address::findOrFail($beneficiary->present_address_id)->update([
                    'type' => "Present",
                    'address_line_one' => $request->permanent_address_line_one,
                    'address_line_two' => $request->permanent_address_line_two,
                    'region' => $request->permanent_region,
                    'province' => $request->permanent_province,
                    'city' => $request->permanent_city,
                    'barangay' => $request->permanent_barangay,
                    'postal_code' => $request->permanent_postal_code,
                ]);
            }

            # Validation and Creating New Provincial Address
            if ($checkbox2 == 1) {
                # Begin Updating the Provincial Address set to NO Values
                Address::findOrFail($beneficiary->provincial_address_id)->update([
                    'type' => "provincial",
                    'address_line_one' => "",
                    'address_line_two' => "",
                    'region' => "",
                    'province' => "",
                    'city' => "",
                    'barangay' => "",
                    'postal_code' => "",
                ]);
            } else {
                $request->validate([
                    #Provincial Address
                    'provincial_address_line_one' => ['required', 'string', 'min:5', 'max:128'],
                    'provincial_address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
                    'provincial_region' => ['required', 'string', 'min:3', 'max:64'],
                    'provincial_province' => ['required', 'string', 'min:3', 'max:64'],
                    'provincial_city' => ['nullable', 'string', 'min:3', 'max:64'],
                    'provincial_barangay' => ['nullable', 'string', 'min:3', 'max:64'],
                    'provincial_postal_code' => ['required', 'numeric', 'digits:4'],
                ], [
                    #Custom Error Message
                    'provincial_postal_code.digits' => 'The postal code must have 4 numbers.',
                ]);

                # Begin Updating the Provincial Address with its NEW values
                Address::findOrFail($beneficiary->provincial_address_id)->update([
                    'type' => "provincial",
                    'address_line_one' => $request->provincial_address_line_one,
                    'address_line_two' => $request->provincial_address_line_two,
                    'region' => $request->provincial_region,
                    'province' => $request->provincial_province,
                    'city' => $request->provincial_city,
                    'barangay' => $request->provincial_barangay,
                    'postal_code' => $request->provincial_postal_code,
                ]);
            }

            $notification = array(
                'message' => 'Part 1 of this beneficiary record has been updated successfully!',
                'alert-type' => 'success',
            );

            # Create Audit Logs
            //TO DO --- Not sure if this will work.
            //            $uuid = Str::uuid()->toString();
            //
            //            $log = new AuditLog;
            //            $log->user_id = Auth::user()->id;
            //            $log->action_type = 'UPDATE';
            //            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
            //            $log->table_name = 'Beneficiaries';
            //            $log->record_id = $uuid;
            //            $log->action = 'Charity User updated beneficiary [' . $request->last_name . ', '. $request->first_name . ' ' . $request->middle_name . ']';
            //            $log->performed_at = Carbon::now();
            //            $log->save();

            return redirect()->route('charity.beneficiaries.show', $beneficiary->code)->with($notification);
        }
    }

    public function delete($id)
    {
        # Retrieve the beneficiary record using Id
        $beneficiaryDelete = Beneficiary::where('id', $id)->orWhere('code', $id)->firstOrFail();

        if (!$beneficiaryDelete->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only delete their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            # Delete the Profile Photo from the path
            $deletePhoto = $beneficiaryDelete->profile_photo;
            if ($deletePhoto) unlink(public_path('upload/charitable_org/beneficiary_photos/') . $deletePhoto);

            # Delete dependent records of beneficiary
            BeneficiaryFamilyInfo::where('beneficiary_id', $beneficiaryDelete->id)->delete();
            BeneficiaryBgInfo::where('beneficiary_id', $beneficiaryDelete->id)->delete();

            # Delete the beneficiary
            $beneficiaryDelete->delete();

            # Delete independent records
            Address::where('id', $beneficiaryDelete->permanent_address_id)->delete();
            Address::where('id', $beneficiaryDelete->present_address_id)->delete();
            Address::where('id', $beneficiaryDelete->provincial_address_id)->delete();

            # Create Audit Logs
            //TO DO --- Not sure if this will work.
            //            $uuid = Str::uuid()->toString();
            //
            //            $log = new AuditLog;
            //            $log->user_id = Auth::user()->id;
            //            $log->action_type = 'DELETE';
            //            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
            //            $log->table_name = 'Beneficiaries';
            //            $log->record_id = $uuid;
            //            $log->action = 'Charity User deleted beneficiary [' . $request->last_name . ', '. $request->first_name . ' ' . $request->middle_name . ']';
            //            $log->performed_at = Carbon::now();
            //            $log->save();

            # Send Notification to each user in their Charitable Organizations
            //            $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
            //
            //            foreach ($users as $user) {
            //                Notification::insert([
            //                    'code' => Str::uuid()->toString(),
            //                    'user_id' => $user->id,
            //                    'category' => 'Beneficiary',
            //                    'Subject' => 'Beneficiary Record Deleted',
            //                    'message' => 'The Beneficiary Record of '. $beneficiaryDelete->last_name . ', ' . $beneficiaryDelete->first_name . ', ' . $beneficiaryDelete->middle_name .
            //                        ' has been deleted by [' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name . ']',
            //                    'icon' => 'mdi mdi-account-remove',
            //                    'color' => 'success',
            //                    'created_at' => Carbon::now(),
            //                ]);
            //            }

            $notification = array(
                'message' => 'A beneficiary record has been deleted successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('charity.beneficiaries.all')->with($notification);
        }
    }

    public function editPart(Request $request, $id)
    {
        # Retrieve the beneficiary record using Id
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstOrFail();

        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            # Redirect the user to the edit page based on the selected part
            if ($request->edit_part == 1) {
                return redirect()->route('charity.beneficiaries.edit', $id);
            } elseif ($request->edit_part == 2) {
                return redirect()->route('charity.beneficiaries2.editPart2', $id);
            } elseif ($request->edit_part == 3) {
                return redirect()->route('charity.beneficiaries3.editPart3', $id);
            } else {
                return to_route('charity.beneficiaries.show', $id);
            }
        }
    }
}
