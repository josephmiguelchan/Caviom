<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsCharityUser
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
        if (Auth::user()->role == "Charity Admin" or Auth::user()->role == "Charity Associate") {
            return $next($request);
        }

        $notification = array(
            'message' => 'Error, only Charity Users can access this page.',
            'alert-type' => 'error',
        );

        return to_route('dashboard')->with($notification);
    }
}
