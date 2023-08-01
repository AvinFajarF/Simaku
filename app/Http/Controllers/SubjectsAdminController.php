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

}
