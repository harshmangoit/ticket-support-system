<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role == 1) {
            // Admin
            return $next($request);
        }
        // } elseif ($request->user() && $request->user()->role == 2) {
        //     // Agent
        //     return redirect('/dashboard');
        // } elseif ($request->user() && $request->user()->role == 3) {
        //     // Regular User
        //     return redirect('/dashboard');
        // }
        else {
            return redirect()->back();
        }
    }
}