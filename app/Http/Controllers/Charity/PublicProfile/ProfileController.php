<?php

namespace App\Http\Controllers\Charity\PublicProfile;

use App\Http\Controllers\Controller;
use App\Models\CharitableOrganization;
use App\Models\Charity\Profile\ProfileCoverPhoto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        return view('charity.main.profile.setup');
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
    public function storeProfile(Request $request)
    {
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
