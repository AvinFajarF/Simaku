<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherJournalSelections extends Model
{
    use HasFactory;

    protected $table = 'teacher_journal_selections';

    protected $fillable = [
        "name",
        "status",
        "teacher_journal_id",
        "student_active_id"
    ];
}
