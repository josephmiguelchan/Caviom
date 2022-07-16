<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\CharitableOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharityController extends Controller
{
    // Redirect to Dashboard
    public function showDashboard()
    {
        $my_charity = CharitableOrganization::findOrFail(Auth::user()->charitable_organization_id);
        return view('charity.index', compact('my_charity'));
    }

    // Logout User
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
