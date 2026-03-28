<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ConditionalVerified
{
    /**
     * Only enforce email verification if
     * config('mlm.registration.email_verification_required') is true.
     *
     * When disabled, the middleware is transparent — the request passes through
     * exactly as if 'verified' was never applied.
     */
    public function handle(Request $request, Closure $next, string $redirectToRoute = 'verification.notice'): mixed
    {
        // Verification not required — skip entirely
        if (! config('mlm.registration.email_verification_required', true)) {
            return $next($request);
        }

        // Same logic as Laravel's built-in EnsureEmailIsVerified middleware
        if (! $request->user() || ! $request->user()->hasVerifiedEmail()) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route($redirectToRoute));
        }

        return $next($request);
    }
}