<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Check if the user has the required role
            if (Auth::user()->role_name == $role || Auth::user()->role_name == 'Super Admin') {
                return $next($request);
            }
        }

        // If the user doesn't have the required role, redirect or show an error
        return redirect('/login'); // You can customize the redirection URL
    }
}
