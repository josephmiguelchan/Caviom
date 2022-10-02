<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            # Changes the status of user from Pending to Active
            $user = Auth::user();
            $user->status = 'Active';
            $user->save();

            event(new Verified($request->user()));

            # Create New Audit Logs for Login.
            $log_in = new AuditLog();
            $log_in->user_id = Auth::user()->id;
            $log_in->action_type = 'LOGIN';
            $log_in->charitable_organization_id = Auth::user()->charitable_organization_id;
            $log_in->table_name = null;
            $log_in->record_id = null;
            $log_in->action = Auth::user()->role . ' [' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name .
                '] has logged in for the first time on ' . Carbon::now()->toDayDateTimeString() . ' using Client IP Address: ' .
                $request->ip();
            $log_in->performed_at = Carbon::now();
            $log_in->save();
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
