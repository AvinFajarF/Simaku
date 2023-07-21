<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherPermissionsController extends Controller
{

    public function createIzin(Request $request) {
        $validasi = $request->validate([
            "name" => "required|string",
            "date" => "required|string",
            "class" => "required",
            "at_hour" => "required",
            "type" => "required",
            ""
        ]);

        


    }

}
