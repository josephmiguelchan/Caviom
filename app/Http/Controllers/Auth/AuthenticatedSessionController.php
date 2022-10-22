<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AuditLog;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        # Create Audit Log only if the user's status is active
        if (Auth::user()->status == 'Active') {

            # Create Audit Logs record for User Login
            $log_in = new AuditLog();
            $log_in->user_id = Auth::user()->id;
            $log_in->action_type = 'LOGIN';
            $log_in->charitable_organization_id = Auth::user()->charitable_organization_id;
            $log_in->table_name = null;
            $log_in->record_id = null;
            $log_in->action = Auth::user()->role . ' has successfully logged in on ' . Carbon::now()->toDayDateTimeString() . ' using Client IP Address: ' .
                $request->ip();
            $log_in->performed_at = Carbon::now();
            $log_in->save();
        }

        if (Auth::user()->role == "Root Admin") {
            return to_route('admin.panel');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
