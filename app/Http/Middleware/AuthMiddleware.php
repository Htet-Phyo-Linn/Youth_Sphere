<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!empty(Auth::user())) {
            // if we go to register page or login page
            if (url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')) {
                return back();
            }
            return $next($request);
        }
        return $next($request);
    }
}
