<?php

namespace App\Http\Controllers;

use App\Models\CharitableOrganization;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function showHome()
    {
        return view('public.v2.index');
    }
    public function showAbout()
    {
        return view('public.v2.pages.about');
    }
    public function showServices()
    {
        return view('public.v2.pages.services');
    }
    public function showContact()
    {
        return view('public.v2.pages.contact');
    }
    public function showAllCharities()
    {
        return view('public.v2.pages.charities');
    }
    public function viewCharity(/*$code*/) // Uncomment the $code here
    {
        $code = 'c3d1d1c5-6665-4b68-ad54-ceeb973a9348'; // This is just a test sample uuid and this line should be REMOVED.
        $charity = CharitableOrganization::where('code', $code)->firstOrfail();

        if ($charity->profile_status != 'Visible') {
            $notification = array(
                'message' => 'Sorry, the Public Profile of this Charitable Organization might be Locked or Hidden.',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $charity->view_count += 1;
        $charity->save();

        return view('public.charities.view', compact('charity'));
    }
    public function viewFeaturedProject()
    {
        return view('public.charities.components.feat-projects.view');
    }
}
