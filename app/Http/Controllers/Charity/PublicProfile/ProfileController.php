<?php

namespace App\Http\Controllers\Charity\PublicProfile;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AuditLog;
use App\Models\CharitableOrganization;
use App\Models\Charity\Profile\ProfileCoverPhoto;
use App\Models\Charity\Profile\ProfilePrimaryInfo;
use App\Models\Charity\Profile\ProfileSecondaryInfo;
use App\Models\Charity\Profile\ProfileAward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function showProfileIndex()
    {
        return view('charity.main.profile.index');
    }
    public function setupProfile()
    {
        # Only users with Unset Public Profile of their Charity can access this function
        if (Auth::user()->charity->profile_status != "Unset") {
            $notification = array(
                'message' => 'Sorry, only Public Profiles that have not been set up yet can access this page.',
                'alert-type' => 'error',
            );

            return to_route('charity.profile')->with($notification);
        }

        $primaryInfo = ProfilePrimaryInfo::where('charitable_organization_id', Auth::user()->charitable_organization_id)->first();
        $secondaryInfo = ProfileSecondaryInfo::where('charitable_organization_id', Auth::user()->charitable_organization_id)->first();
        $awards = ProfileAward::where('charitable_organization_id', Auth::user()->charitable_organization_id)->take(5)->get();

        return view('charity.main.profile.setup', compact(['primaryInfo', 'secondaryInfo', 'awards']));
    }
    public function dropZoneCoverPhotos(Request $request)
    {
        # Get existing cover photos from DB
        $existing_photos = ProfileCoverPhoto::where('charitable_organization_id', Auth::user()->charitable_organization_id)->get();

        # Only add if not exceeding 5
        if ($existing_photos->count() < 5) {
            # Upload files to folder of cover photos
            $image = $request->file('file');
            $imageName = 'cover_photo_' . date('YmdHi') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/charitable_org/cover_photos/'), $imageName);

            # Update DB with the filename of cover photo
            $cover_photo = new ProfileCoverPhoto;
            $cover_photo->charitable_organization_id = Auth::user()->charitable_organization_id;
            $cover_photo->file_name = $imageName;
            $cover_photo->updated_at = Carbon::now();
            $cover_photo->save();
            return response()->json(['success' => $imageName]);
        }

        return response()->json(['success' => 'ERROR: Max of 5 photos has been reached.']);
    }
    public function getImages()
    {
        # Get existing cover photos from DB and display them on upload modal.
        $images = ProfileCoverPhoto::where('charitable_organization_id', Auth::user()->charitable_organization_id)->take(5)->get()->toArray();
        foreach ($images as $image) {
            $tableImages[] = $image['file_name'];
        }
        $storeFolder = public_path('upload/charitable_org/cover_photos');
        $file_path = public_path('upload/charitable_org/cover_photos/');
        $files = scandir($storeFolder);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('upload/charitable_org/cover_photos/') . $file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url('upload/charitable_org/cover_photos/' . $file);
                $data[] = $obj;
            }
        }
        return response()->json($data);
    }
    public function destroy(Request $request)
    {
        $filename =  $request->get('filename');
        ProfileCoverPhoto::where('file_name', $filename)->delete();
        $path = public_path('upload/charitable_org/cover_photos/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }
    public function storePrimaryInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            # Basic Info
            'profile_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file', 'dimensions:ratio=1.0'],
            'category' => ['required', Rule::in(['Community', 'Education', 'Human', 'Health', 'Environment', 'SocialWelfare', 'Corporate', 'Church', 'Livelihood', 'SportsVolunteerism'])],
            'tagline' => ['nullable', 'string', 'max:200'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:100'],
            'cel_no' => ['required', 'regex:/(09)[0-9]{9}/'], // 09 + (Any 9-digit number from 1-9)
            'tel_no' => ['nullable', 'regex:/(8)[0-9]{7}/'], // 8 + (Any 7-digit number from 1-9)

            # Address
            'address_line_one' => ['required', 'string', 'min:5', 'max:128'],
            'address_line_two' => ['nullable', 'string', 'min:5', 'max:128'],
            'province' => ['required', 'string', 'min:3', 'max:64'],
            'region' => ['required', 'string', 'min:3', 'max:64'],
            'city' => ['required', 'string', 'min:3', 'max:64'],
            'barangay' => ['required', 'string', 'min:3', 'max:64'],
            'postal_code' => ['required', 'integer', 'digits:4'],
        ], [
            'profile_photo.dimensions' => 'Profile photo of the Organization must be 1x1 in ratio.',
            'category.array' => 'Invalid category.',
            'cel_no.regex' => 'The cel no format must be followed. Ex. 09981234567',
            'tel_no.regex' => 'The tel no format must be followed. Ex. 82531234',
        ]);

        # Return error toastr if validate request failed
        if ($validator->fails()) {

            $toastr = array(
                'message' => $validator->errors()->first() . ' Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        # Retrieve Charity Data from DB
        $charity = CharitableOrganization::findOrFail(Auth::user()->charitable_organization_id);

        # Do this only when input field: profile_photo has a value
        if ($request->file('profile_photo')) {

            # Delete old Profile photo if exists
            $oldImg = $charity->profile_photo;
            if ($oldImg) unlink(public_path('upload/charitable_org/profile_photo/') . $oldImg);

            # Upload profile photo of the Charitable Organization to the server
            $file = $request->file('profile_photo');
            $filename = Str::limit($charity->name, 50, '') . ' - ' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/charitable_org/profile_photo/'), $filename);

            # Link the profile photo to the Charity Data by updating DB
            $charity->profile_photo = $filename;
            $charity->save();
        }

        # Check if the Charity already has an existing address in profile_primary_info in DB.
        $profile_exists = ProfilePrimaryInfo::where('charitable_organization_id', $charity->id)->first();

        if ($profile_exists) {

            # Update Address
            $address = Address::find($profile_exists->address_id);
            $address->address_line_one = $request->address_line_one;
            $address->address_line_two = $request->address_line_two;
            $address->region = $request->region;
            $address->province = $request->province;
            $address->city = $request->city;
            $address->postal_code = $request->postal_code;
            $address->barangay = $request->barangay;
            $address->update();

            # Update Primary Info
            $profile_exists->update([
                'charitable_organization_id' => Auth::user()->charitable_organization_id,
                'category' => $request->category,
                'tagline' => $request->tagline,
                'email_address' => $request->email,
                'cel_no' => $request->cel_no,
                'tel_no' => $request->tel_no,
                'updated_at' => Carbon::now(),
            ]);

            # Audit Logs (Update)
            AuditLog::create([
                'user_id' => Auth::id(),
                'action_type' => 'UPDATE',
                'charitable_organization_id' => Auth::user()->charitable_organization_id,
                'table_name' => 'Profile Primary Info, Address',
                'record_id' => Auth::user()->charity->code,
                'action' => Auth::user()->role . ' saved ' . Auth::user()->charity->name . '\'s Public Profile primary information.',
                'performed_at' => Carbon::now(),
            ]);
        } else {

            # Create New Data to addresses table
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

            # Create New Profile Primary Info
            ProfilePrimaryInfo::create([
                'charitable_organization_id' => Auth::user()->charitable_organization_id,
                'address_id' => $address->id,
                'category' => $request->category,
                'tagline' => $request->tagline,
                'email_address' => $request->email,
                'cel_no' => $request->cel_no,
                'tel_no' => $request->tel_no,
                'updated_at' => Carbon::now(),
            ]);

            # Audit Logs (Insert)
            AuditLog::create([
                'user_id' => Auth::id(),
                'action_type' => 'INSERT',
                'charitable_organization_id' => Auth::user()->charitable_organization_id,
                'table_name' => 'Profile Primary Info, Address',
                'record_id' => Auth::user()->charity->code,
                'action' => Auth::user()->role . ' updated ' . Auth::user()->charity->name . '\'s Public Profile primary information.',
                'performed_at' => Carbon::now(),
            ]);
        }

        # Throw success toastr
        $toastr = array(
            'message' => 'Profile has been updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->withInput()->with($toastr);
    }
    public function storeAwards(Request $request)
    {
        $validator = Validator::make($request->all(), [
            # Awards
            'award_name' => ['required', 'string', 'max:200', 'min:10'],
            'file_link' => ['nullable', 'url', 'max:250', 'min:10'],
        ]);

        # Return error toastr if validate request failed
        if ($validator->fails()) {

            $toastr = array(
                'message' => $validator->errors()->first() . ' Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        # Return an error toastr if equal to or more than 5 awards have been added already.
        $awards = ProfileAward::where('charitable_organization_id', Auth::user()->charitable_organization_id)->take(5)->get();
        if ($awards->count() >= 5) {
            $toastr = array(
                'message' => 'Only a maximum of 5 awards can be added.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        ProfileAward::create([
            'charitable_organization_id' => Auth::user()->charitable_organization_id,
            'name' => $request->award_name,
            'file_link' => $request->file_link,
        ]);

        $toastr = array(
            'message' => 'Award has been added successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastr);
    }
    public function destroyAward($id)
    {
        $award = ProfileAward::findOrFail($id);
        if ($award->charitable_organization_id != Auth::user()->charitable_organization_id) {
            $toastr = array(
                'message' => 'You can only remove your own Charitable Organization\'s pre-existing award(s).',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->with($toastr);
        }

        $award->delete();

        $toastr = array(
            'message' => 'Selected award has been removed successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->withInput()->with($toastr);
    }
    public function storeSecondaryInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            # Secondary Info
            'our_story' => ['required', 'string', 'max:1300', 'min:10'],
            'our_story_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],
            'our_goal' => ['required', 'string', 'max:1300', 'min:10'],
            'our_goal_photo' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],

        ]);

        # Return error toastr if validate request failed
        if ($validator->fails()) {

            $toastr = array(
                'message' => $validator->errors()->first() . ' Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        # Check if the Charity already has an existing address in profile_secondary_info in DB.
        $profile_secondary_exists = ProfileSecondaryInfo::where('charitable_organization_id', Auth::user()->charitable_organization_id)->first();

        if ($profile_secondary_exists) {
            # Start Updating Database
            $profile_secondary_exists->charitable_organization_id = Auth::user()->charitable_organization_id;
            $profile_secondary_exists->our_story = $request->our_story;
            $profile_secondary_exists->our_goal = $request->our_goal;

            # Upload the image only when our_story_photo has value...
            if ($request->file('our_story_photo')) {

                # Delete old Story photo if exists
                $oldImg = $profile_secondary_exists->our_story_photo;
                if ($oldImg) unlink(public_path('upload/charitable_org/our_story/') . $oldImg);

                # Upload New Story photo to the server
                $file = $request->file('our_story_photo');
                $filename = 'Our_story_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/charitable_org/our_story/'), $filename);

                # Link the story photo to the Profile by updating DB
                $profile_secondary_exists->our_story_photo = $filename;
            }

            # Upload the image only when our_goal_photo has value...
            if ($request->file('our_goal_photo')) {

                # Delete old Story photo if exists
                $oldImg = $profile_secondary_exists->our_goal_photo;
                if ($oldImg) unlink(public_path('upload/charitable_org/our_goal/') . $oldImg);

                # Upload profile photo of the Charitable Organization to the server
                $file = $request->file('our_goal_photo');
                $filename = 'Our_goal_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/charitable_org/our_goal/'), $filename);

                # Link the profile photo to the Charity Data by updating DB
                $profile_secondary_exists->our_goal_photo = $filename;
            }

            $profile_secondary_exists->updated_at = Carbon::now();
            $profile_secondary_exists->save();
        } else {

            # Start Creating New Record in the Database
            $secondaryInfo = new ProfileSecondaryInfo;
            $secondaryInfo->charitable_organization_id = Auth::user()->charitable_organization_id;
            $secondaryInfo->our_story = $request->our_story;
            $secondaryInfo->our_goal = $request->our_goal;

            # Upload the image only when our_story_photo has value...
            if ($request->file('our_story_photo')) {

                # Upload profile photo of the Charitable Organization to the server
                $file = $request->file('our_story_photo');
                $filename = 'Our_story_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/charitable_org/our_story/'), $filename);

                # Link the profile photo to the Charity Data by updating DB
                $secondaryInfo->our_story_photo = $filename;
            }

            # Upload the image only when our_goal_photo has value...
            if ($request->file('our_goal_photo')) {

                # Upload profile photo of the Charitable Organization to the server
                $file = $request->file('our_goal_photo');
                $filename = 'Our_goal_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/charitable_org/our_goal/'), $filename);

                # Link the profile photo to the Charity Data by updating DB
                $secondaryInfo->our_goal_photo = $filename;
            }

            $secondaryInfo->save();
        }

        # Throw success toastr
        $toastr = array(
            'message' => 'Profile (Secondary Information) has been updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->withInput()->with($toastr);
    }
    public function applyVerification()
    {
        # Only with unverified status can access this function
        if (Auth::user()->charity->verification_status != "Unverified") {
            $notification = array(
                'message' => 'Only unverified charitable organizations can apply for verification.',
                'alert-type' => 'error',
            );

            return to_route('charity.profile')->with($notification);
        }

        return view('charity.main.profile.verify');
    }
    public function reapplyVerification()
    {
        # Only with declined applications can access this function
        if (Auth::user()->charity->verification_status != "Declined") {
            $notification = array(
                'message' => 'Only declined charitable organizations can re-apply for verification.',
                'alert-type' => 'error',
            );

            return to_route('charity.profile')->with($notification);
        }

        # Clear profile_requirements table where charity == Auth::user()->charity


        # Set visibility_status from Declined to Unverified
        $charity = CharitableOrganization::findOrFail(Auth::user()->charity->id);
        $charity->verification_status = 'Unverified';
        $charity->save();

        # redirect to applyVerification function
        return to_route('charity.profile.verify');
    }
    public function editProfile()
    {
        $charity = CharitableOrganization::findOrFail(Auth::user()->charity->id);


        return view('', compact('charity')); // To Change
    }
    public function updateProfile(Request $request)
    {
        # code...
    }
}
