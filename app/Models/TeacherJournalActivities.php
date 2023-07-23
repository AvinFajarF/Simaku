<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherJournalActivities extends Model
{
    use HasFactory;

    protected $table = 'teacher_journal_activities';

    protected $fillable = [
        'teacher_id',
        'teacher_journal_id',
    ];

}
