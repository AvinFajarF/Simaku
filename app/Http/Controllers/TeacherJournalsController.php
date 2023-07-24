<?php

namespace App\Http\Controllers;

use App\Models\TeacherJournalActivities;
use App\Models\TeacherJournals;
use App\Models\Teachers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherJournalsController extends Controller
{
    public function CreateJournals(Request $request)
    {

        $validasi = $request->validate([
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
            $validasi["name"] = $TeacherId->name;

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
            ], 400);
        }
    }
}
