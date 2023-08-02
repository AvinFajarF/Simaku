<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;

class SubjectsAdminController extends Controller
{

    public function index(){
        return view("admin.mata_pelajaran.index",["subjects" => Subjects::all()]);
    }

    public function create(Request $request) {

        $validasi = $request->validate([
            "code" => "required",
            "name" => "required"
        ]);

        Subjects::create($validasi);

        return redirect()->back();
    }

    public function update($id, Request $request) {
        $validasi = $request->validate([
            "name" => "string"
        ]);
        $validasi["code"] = $request->code;

        $SubjectFind = Subjects::findOrFail($id);
        $SubjectFind->update(["name" => $validasi["name"], "code" => $validasi["code"]]);

        return redirect()->back();
    }


    

}
