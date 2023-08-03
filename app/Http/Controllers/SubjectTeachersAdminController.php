<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use App\Models\SubjectTeachers;
use App\Models\Teachers;
use Illuminate\Http\Request;

class SubjectTeachersAdminController extends Controller
{
    public function index(){
        $teachers = Teachers::all();
        $subjects = Subjects::all();
        $subjectsTeacher = SubjectTeachers::with(["teachers", 'subject'])->get();

        return view("admin.guru_mata_pelajaran.index", [
            "teacher" => $teachers,
            "subject" => $subjects,
            "subjectsTeacher" => $subjectsTeacher
        ]);
    }

    public function create(Request $request){
        $validasi = $request->validate([
            "class" => "required",
            "subject_id" => "required",
            "teacher_id" => "required"
        ]);

        SubjectTeachers::create([
            "class" => $validasi["class"],
            "subject_id" => $validasi["subject_id"],
            "teacher_id" => $validasi["teacher_id"],
        ]);

        return redirect()->back();
    }

    public function update($id,Request $request){
        $validasi = $request->validate([
            "class" => "nullable",
            "subject_id" => "nullable",
            "teacher_id" => "nullable"
        ]);

        $subjectTeachersFind = SubjectTeachers::findOrFail($id);

        $subjectTeachersFind->update([
            "class" => $validasi["class"],
            "subject_id" => $validasi["subject_id"],
            "teacher_id" => $validasi["teacher_id"],
        ]);

        return redirect()->back();
    }

    public function destroy($id){
        $subjectTeachersFind = SubjectTeachers::findOrFail($id);

        $subjectTeachersFind->delete();

        return redirect()->back();
    }

}
