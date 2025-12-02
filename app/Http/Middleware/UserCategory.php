<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check urser admin
        if (! Auth::guard('admin')->check()) {
            return redirect()->route('login.create')->with('error', 'Please login!');
        }

        if (! Auth::guard('admin')->user()->user_roll == 'admin') {
            return redirect()->route('blog.index')->with('error', 'You have must be admin!');
        }

        return $next($request);
    }
}
