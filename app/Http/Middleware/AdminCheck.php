<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $checkAdmin = User::where("id", Auth::user()->id)->first();
        if ($checkAdmin->role != "admin") {
            return response()->json([
                "error" => "You are not allowed"
            ],403);
        }

        return $next($request);
    }
}
