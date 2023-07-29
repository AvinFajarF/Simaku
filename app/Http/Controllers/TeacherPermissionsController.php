<?php

namespace App\Http\Controllers;

use App\Models\TeacherPermissions;
use App\Models\TeacherPermissionSettings;
use App\Models\Teachers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPermissionsController extends Controller
{

    public function CreateTeacherPermissions(Request $request)
    {


        $validasi = $request->validate([
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

            $teacherId = Teachers::where("user_id", Auth::user()->id)->first();

            $validasi["name"] = $teacherId->name;
            $validasi["teacher_id"] = $teacherId->id;
            $validasi["date"] = $formattedNow;

            if ($request->file('task_file')) {
                $extension = $request->file('task_file')->getClientOriginalExtension();
                $newFileName = $teacherId->name . '-' . now()->timestamp . '.' . $extension;

                $request->file('task_file')->storeAs('file', $newFileName);

                if ($request->file('task_file')) {
                    $request->file('task_file')->move(public_path('storage/file'), $newFileName);
                    $validasi['task_file'] = $newFileName;
                } else {
                    $validasi['task_file'] = $newFileName;
                }

            }


            TeacherPermissions::create($validasi);


            return response()->json([
                "status" => "success",
                "message" => "managed to create permission"
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "failed to create permission",
                "error" => $th->getMessage(),
            ], 400);
        }
    }


    public function TeacherPermissionSettings(Request $request)
    {

        $validasi = $request->validate([
            "day" => "required|string",
            "class" => "required",
            "at_hour" => "required",
        ]);

        try {

            TeacherPermissionSettings::create($validasi);


            return response()->json([
                "status" => "success",
                "message" => "managed to make teacher arrangements"
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "failed to make teacher arrangements"
            ], 400);
        }
    }
}
