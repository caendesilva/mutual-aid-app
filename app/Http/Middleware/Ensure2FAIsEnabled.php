<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Ensure2FAIsEnabled
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
        // Perform a stricter check than the default Laravel email verify middleware
        if (! $request->user() ||
            ! $request->user()->hasVerifiedEmail()) {
            return redirect('/email/verify')->dangerBanner('You need to verify your email to perform this action.');
        }

        if (! $request->user()->hasEnabledTwoFactorAuthentication()) {
            return redirect('/user/profile')->dangerBanner('You need Two Factor Authentication enabled to perform this action.');
        }

        return $next($request);
    }
}
