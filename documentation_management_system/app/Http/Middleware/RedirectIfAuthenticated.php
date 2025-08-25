<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === 'editor') {
                    return redirect()->route('editor.dashboard');
                }

                $user = Auth::guard($guard)->user();

                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role === 'user') {
                    return redirect()->route('user.home');
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
