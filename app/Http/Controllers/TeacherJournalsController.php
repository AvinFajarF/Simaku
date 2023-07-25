<?php

namespace App\Http\Controllers;

use App\Models\Students;
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

            $siswaTidakHadir = 0;
            $siswaHadir = 0;

            if ($request->students) {
                $studentData = [];
                foreach ($request->students as $index => $student) {
                    // $studentIds = collect($request->students)->pluck('id')->toArray();

                    // $students = Students::find($studentIds)->pluck("name");

                    $studentModel = Students::find($student["id"]);

                    $studentName = $studentModel->name;

                    $studentData[] = $student;
                    if ($student["status"] !== "hadir") {
                        $siswaTidakHadir += 1;
                    } else {
                        $siswaHadir += 1;
                    }

                    TeacherJournalSelections::create([
                        "name" => $studentName,
                        "status" => $student["status"],
                        "teacher_journal_id" => $result->id,
                        "student_active_id" => $student["id"]
                    ]);
                }
            }



            // update field student_attend dan student_not_attend
            $getTeacherJournals = TeacherJournals::findOrFail($result->id);
            $getTeacherJournals->student_attend = $siswaHadir;
            $getTeacherJournals->student_not_attend = $siswaTidakHadir;
            $getTeacherJournals->save();




            TeacherJournalActivities::create(["teacher_journal_id" => $result->id, "teacher_id" => $validasi["teacher_id"]]);
            return response()->json([
                "status" => "success",
                "message" => "success to create Journal"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "failed to create Journal",
                "error" => $th->getMessage(),
            ], 400);
        }
    }
}
