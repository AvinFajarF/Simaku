<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjects extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "code",
        "name"
    ];

    protected $dates = ['deleted_at'];
}
