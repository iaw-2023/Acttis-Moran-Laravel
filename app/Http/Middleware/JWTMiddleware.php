<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set("Accept", "application/json");
        try{
            JWTAuth::parseToken()->authenticate();
        }
        catch(Exception $e) {
            return response()->json(['status' => 'Invalid Token.'],401);
        }

        return $next($request);
    }
}
