<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Retrieve the currently authenticated user...
        $admin = Auth::user();

        if($admin->role->role == "basicAdmin"){
            return redirect()->back()->withErrors(["Need Super Admin Permissions!"]);
        }

        return $next($request);
    }
}
