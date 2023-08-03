<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectTeachers extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "class",
        "subject_id",
        "teacher_id"
    ];

    public function teachers(): BelongsTo {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'id');
    }

    public function subject(): BelongsTo {
        return $this->belongsTo(Subjects::class);
    }



    protected $dates = ['deleted_at'];
}
