<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsProfileSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->charity->profile_status != "Unset") {
            return $next($request);
        }

        $notification = array(
            'message' => 'Sorry, your Public Profile must be set up first in order to continue.',
            'alert-type' => 'error',
        );

        return to_route('charity.profile')->with($notification);
    }
}
