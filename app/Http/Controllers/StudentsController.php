<?php

namespace App\Http\Controllers;

use App\Models\ActiveStudents;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
   public function GetStudentData(Request $request)
    {
        $validasi = $request->validate([
            "class" => "required",
        ]);

        try {
            $result = ActiveStudents::with("student.users")->where("class", $validasi["class"])->get();

            if ($result) {
                return response()->json([
                    "status" => "success",
                    "data" => $result,
                ], 200);
            } else {
                return response()->json([
                    "status" => "error",
                    "data" => null,
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "data" => null,
            ], 400);
        }
    }
}
