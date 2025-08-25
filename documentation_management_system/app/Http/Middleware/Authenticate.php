<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        // If any supplied guard is authenticated, continue.
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        // For API/JSON requests, return 401 (no redirect)
        if ($request->expectsJson()) {
            abort(401, 'Unauthenticated.');
        }

        if ($request->method() === 'GET') {
            session()->put('url.intended', $request->fullUrl());
        }

        // Redirect based on guard(s) used on the route/middleware.
        if (in_array('editor', $guards, true)) {
            // Your editor login route name from routes/web.php
            return redirect()->route('editor.login.form');
        }

        if (in_array('admin', $guards, true)) {
            return redirect()->route('admin.login');
        }

        // Fallback to normal user login (web guard)
        return redirect()->route('login');
    }
}
