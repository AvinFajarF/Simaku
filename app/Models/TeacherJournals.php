<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherJournals extends Model
{
    use HasFactory;

    protected $table = 'teacher_journals';

    protected $fillable = [
        "name",
        "date",
        "class",
        "at_hour",
        "subject",
        "description",
        "student_note",
        "student_attend",
        "student_not_attend",
        "teacher_id",
        "subject_id",
    ];
}
