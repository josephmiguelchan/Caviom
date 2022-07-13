<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharityController extends Controller
{
    // Redirect to Dashboard
    public function showDashboard()
    {
        return view('charity.index');
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
