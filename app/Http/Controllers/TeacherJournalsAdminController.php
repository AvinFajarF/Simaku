<?php

namespace App\Http\Controllers;

use App\Models\TeacherJournals;
use Illuminate\Http\Request;

class TeacherJournalsAdminController extends Controller
{

    public function index(Request $request){

        $result = TeacherJournals::whereBetween("created_at",[$request->start_date, $request->end_date])->get();

        return view("admin.jurnal_guru.index", [
            "data" => $result
        ]);

    }

}
