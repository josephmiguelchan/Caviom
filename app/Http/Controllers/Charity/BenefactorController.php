<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Benefactor;
use App\Models\UserInfo;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BenefactorController extends Controller
{
    public function index()
    {
        $benefactors = Benefactor::where('charitable_organization_id', Auth::user()->charitable_organization_id)->latest()->get();
        return view('charity.main.benefactors.all', compact('benefactors'));
    }

    public function show($id)
    {
        $benefactor = Benefactor::where('id', $id)->orWhere('code', $id)->firstOrFail();
        $userInfo = UserInfo::where('id', $benefactor->last_modified_by_id)->firstOrFail();

        # Users can only access their own charity's records
        if (!$benefactor->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            return view('charity.main.benefactors.view', compact('benefactor','userInfo'));

        }
    }

    public function create()
    {
        return view('charity.main.benefactors.add');
    }

    public function store(Request $request)
    {
        # Validation of New Benefactor
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
                'region' => ['required', 'string', 'min:5', 'max:64'],
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

            ]);

        # Creating New Benefactor Address
        $benefactorAddress = new Address;
        $benefactorAddress->type = "Present";
        $benefactorAddress->address_line_one  = $request->address_line_one;
        $benefactorAddress->address_line_two = $request->address_line_two;
        $benefactorAddress->region = $request->region;
        $benefactorAddress->province = $request->province;
        $benefactorAddress->city = $request->city;
        $benefactorAddress->barangay = $request->barangay;
        $benefactorAddress->postal_code = $request->postal_code;
        $benefactorAddress->save();

        # Creating New Benefactor Record
        $benefactor = new Benefactor;
        $benefactor->code = Str::uuid()->toString();

        # Adding Profile Photo
        if ($request->file('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/charitable_org/benefactor_photos/'), $filename);
            $benefactor->profile_photo = $filename;
        }

        # Creating New Benefactor Record Cont.
        $benefactor->first_name = $request->first_name;
        $benefactor->last_name = $request->last_name;
        $benefactor->middle_name = $request->middle_name;
        $benefactor->email_address = $request->email;
        $benefactor->cel_no = $request->cel_no;
        $benefactor->tel_no = $request->tel_no;
        $benefactor->category = $request->category;
        $benefactor->label = $request->label;

        $benefactor->charitable_organization_id = Auth::user()->charitable_organization_id;
        $benefactor->address_id = $benefactorAddress->id;
        $benefactor->last_modified_by_id = Auth::user()->id;
        $benefactor->save();

        # Success toastr message
        $notification = array(
            'message' => 'A new benefactor record has been saved successfully!',
            'alert-type' => 'success',
        );

        # Audit Log
        //TO DO -- Audit log stating that a new benefactor record has been ADDED.

        return redirect()->route('charity.benefactors.all')->with($notification);
    }

    public function edit($id)
    {
        $benefactor = Benefactor::where('id', $id)->orWhere('code', $id)->firstOrFail();
        $userInfo = UserInfo::where('id', $benefactor->last_modified_by_id)->firstOrFail();

        # Users can only access their own charity's records
        if (!$benefactor->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            return view('charity.main.benefactors.edit', compact('benefactor', 'userInfo'));

        }
    }

    public function update(Request $request, $id)
    {
        $benefactor = Benefactor::where('id', $id)->orWhere('code', $id)->firstOrFail();

        # Users can only access their own charity's records
        if (!$benefactor->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            # Validation of Edit Benefactor
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
                    'region' => ['required', 'string', 'min:5', 'max:64'],
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

                ]);

            # Update Benefactor Profile Picture
            if ($request->file('profile_photo')) {

                # Delete old Profile Image if exists
                $oldImg = $benefactor->profile_photo;
                if ($oldImg) unlink(public_path('upload/charitable_org/benefactor_photos/') . $oldImg);

                # Replace with Uploaded New Profile Image
                $file = $request->file('profile_photo');
                $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/charitable_org/benefactor_photos/'), $filename);
                $benefactor->profile_photo = $filename;
                $benefactor->save();
            }

            # Begin Updating the Benefactor Record
            Benefactor::findOrFail($benefactor->id)->update([
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
            Address::findOrFail($benefactor->address_id)->update([
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
                'message' => 'Benefactor record has been updated successfully!',
                'alert-type' => 'success',
            );

            # Audit Log
            //TO DO -- Audit log stating that a new benefactor record has been UPDATED.

            return redirect()->route('charity.benefactors.view', $benefactor->code)->with($notification);

        }
    }

    public function delete($id)
    {
        # Retrieve the benefactor record using Id
        $benefactor = Benefactor::where('id', $id)->orWhere('code', $id)->firstOrFail();

        if (!$benefactor->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only delete their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {
            # Delete the Profile Photo from the path
            $deletePhoto = $benefactor->profile_photo;
            if($deletePhoto)unlink(public_path('upload/charitable_org/benefactor_photos/').$deletePhoto);

            # Delete the beneficiary
            $benefactor->delete();

            # Delete independent records
            Address::where('id', $benefactor->address_id)->delete();

            $notification = array(
                'message' => 'A benefactor record has been deleted successfully!',
                'alert-type' => 'success',
            );

            # Audit Log
            //TO DO -- Audit log stating that a new benefactor record has been DELETED.

            # Notification
            //TO DO -- Send notification to the organization about the action.

            return redirect()->route('charity.benefactors.all')->with($notification);
        }

    }

}
