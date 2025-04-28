<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->usertype == 'admin')
 {
            // ✅ User is logged in and is an admin
            return $next($request); // allow request to continue
        }
    
        // ❌ User is not admin
        return redirect()->back()->with('unauthorized', 'You are not authorized to access this page.');
    }
}
