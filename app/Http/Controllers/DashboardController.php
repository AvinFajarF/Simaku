<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\TeacherJournals;
use App\Models\Teachers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $teacherCount = Teachers::all()->count();
        $studentsCount = Students::all()->count();

        // chart js
        date_default_timezone_set("Asia/Jakarta");

        $jurnal_guru_per_hari = TeacherJournals::whereDate('date', Carbon::today())
            ->select([
                'student_attend',
                'student_not_attend',
                'date'
            ])
            ->get()
            ->toArray();

        $jurnal_guru_per_minggu = [];

        for ($i = 0; $i < 7; $i++) {
            $start_date = Carbon::today()->subDays($i)->format('Y-m-d');
            $end_date = Carbon::today()->format('Y-m-d');

            $jurnal_guru = TeacherJournals::whereBetween('date', [$start_date, $end_date])
                ->select([
                    'student_attend',
                    'student_not_attend',
                    'class',
                    'date'
                ])
                ->orderBy('date', 'desc')
                ->get()
                ->toArray();

            array_push($jurnal_guru_per_minggu, $jurnal_guru);
        }

        $jurnal_guru_per_hari = json_encode($jurnal_guru_per_hari);
        $jurnal_guru_per_minggu = json_encode($jurnal_guru_per_minggu);

        $thl = Carbon::today();


        return view("admin.index", [
            "teacherCount" => $teacherCount,
            "studentsCount" => $studentsCount,
            "jurnal_guru_per_hari" => $jurnal_guru_per_hari,
            "jurnal_guru_per_minggu" => $jurnal_guru_per_minggu,
            "date" => $thl
            ]);
    }


}
