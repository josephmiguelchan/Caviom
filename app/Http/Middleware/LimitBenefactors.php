<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LimitBenefactors
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
        if (Auth::user()->charity->benefactors->count() < 300) {
            return $next($request);
        }

        $notification = array(
            'message' => 'Sorry, your Charitable Organization has reached the maximum no. of (300) Benefactors.',
            'alert-type' => 'error',
        );

        return to_route('charity.benefactors.all')->with($notification);
    }
}
