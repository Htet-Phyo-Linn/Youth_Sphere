<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            // \Log::info('User role: ' . $userRole);
            // \Log::info('Admin route check: ' . ($request->is('admin/*') ? 'true' : 'false'));
            // \Log::info('Request path: ' . $request->path());  // Should be something like 'admin/dashboard'
            // dd($request->path());
            // dd($request->is('admin/*') && $userRole !== 'admin');
                // Admin-specific routes protection
            if ($request->is('admin*') && $userRole !== 'admin') {
                return abort(403, 'Unauthorized');
            }

            // Manager-specific routes protection
            if ($request->is('manager*') && $userRole !== 'manager') {
                return abort(403, 'Unauthorized');
            }

            // Instructor-specific routes protection
            if ($request->is('instructor*') && $userRole !== 'instructor') {
                return abort(403, 'Unauthorized');
            }

            // Student-specific routes protection
            if ($request->is('student*') && $userRole !== 'student') {
                return abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
