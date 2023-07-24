<?php

namespace App\Http\Controllers;

use App\Models\ActiveStudents;
use App\Models\TeacherJournalActivities;
use App\Models\TeacherJournals;
use App\Models\TeacherJournalSelections;
use App\Models\Teachers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherJournalsController extends Controller
{


    public function CreateJournals(Request $request)
    {

        $validasi = $request->validate([
            "name" => "string|required",
            "date" => "required",
            "class" => "string|required",
            "at_hour" => "required",
            "subject" => "required|string",
            "description" => "required|string",
            "student_note" => "required|string",
            "subject_id" => "required",
        ]);


        try {

            $now = Carbon::now();
            $formattedNow = $now->format('d/m/Y h:i A');

            $validasi["date"] = $formattedNow;

            $TeacherId = Teachers::where("user_id", Auth::user()->id)->first();
            $validasi["teacher_id"] = $TeacherId->id;



            $result = TeacherJournals::create($validasi);

            if ($result) {
                TeacherJournalActivities::create(["teacher_journal_id" => $result->id, "teacher_id" => $validasi["teacher_id"]]);

                return response()->json([
                    "status" => "success",
                    "message" => "managed to create Journal",
                    "data" => $result,
                ], 201);
            }
                return response()->json([
                    "status" => "failed",
                    "message" => "failed to create Journal"
                ], 400);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "failed to create Journal",
                "error" => $th
            ], 400);
        }
    }

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

    public function CreateTeacherJournalSelections(Request $request)
    {

        $validasi = $request->validate([
            "name" => "required|string",
            "status" => "required",
            "teacher_journal_id" => "required",
            "student_active_id" => "required",
        ]);

        try {

            $result = TeacherJournalSelections::create($validasi);
            if ($result) {
                return response()->json([
                    "status" => "success",
                    "data" => $result,
                ], 201);
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
                "error" => $th
            ], 400);
        }
    }
}
