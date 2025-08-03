<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if we have a just-verified session flag
        if ($request->session()->has('verified_email')) {
            // Remove the flag so it's only used once
            $request->session()->forget('verified_email');
            return $next($request);
        }
        
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
            
            // If the user is logged in but not verified, log them out and redirect
            if ($request->user()) {
                auth()->logout();
                return redirect()->route('login')
                    ->with('message', 'Ваш адрес электронной почты не подтвержден. Пожалуйста, проверьте свою почту для подтверждения.');
            }
            
            return redirect()->route('login');
        }

        return $next($request);
    }
}
