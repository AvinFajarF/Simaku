<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPermissionSettings extends Model
{
    use HasFactory;

    protected $table = 'teacher_permission_settings';

    protected $fillable = [
            'day',
            'class',
            'at_hour'
        ];

}
