<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPermissions extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "date",
        "class",
        "at_hour",
        "type",
        "room",
        "task_instruction",
        "task_file",
        "permission_letter",
        "teacher_id",
    ];
}
