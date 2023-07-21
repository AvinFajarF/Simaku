<?php

namespace App\Http\Controllers;

use App\Models\TeacherPermissions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPermissionsController extends Controller
{

    public function CreateTeacherPermissions(Request $request)
    {
        $validasi = $request->validate([
            "name" => "required|string",
            "date" => "required|string",
            "class" => "required",
            "at_hour" => "required",
            "type" => "required",
            "room" => "required",
            "task_instruction" => "required|string",
            "task_file" => "required",
            "permission_letter" => "required|string",
        ]);

        try {

            $now = Carbon::now();
            $formattedNow = $now->format('d/m/Y h:i A');

            $validasi["teacher_id"] = Auth::user()->id;
            $validasi["date"] = $formattedNow;

            $result = TeacherPermissions::create($validasi);

            if ($result) {
                return response()->json([
                    "status" => "success",
                    "message" => "managed to create permission"
                ],201);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => "failed to create permission"
                ],401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "failed to create permission"
            ],401);
        }
    }


    public function teacherPermissionSettings(Request $request)
    {

        $validasi = $request->validate([
            "day" => "required|string",
            "class" => "required",
            "at_hour" => "required",
        ]);

        try {
        } catch (\Throwable $th) {
        }
    }
}
