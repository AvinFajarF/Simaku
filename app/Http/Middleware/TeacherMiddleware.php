<?php

namespace App\Http\Middleware;

use App\Models\TeacherPermissions;
use App\Models\Teachers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $checkTecher = Teachers::where("user_id", Auth::user()->id)->first();

        if (!$checkTecher || $checkTecher->status == "off") {
            return response()->json(["message" => "You are not a teacher"], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
