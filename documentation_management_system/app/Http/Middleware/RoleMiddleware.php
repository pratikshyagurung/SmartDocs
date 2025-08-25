<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
