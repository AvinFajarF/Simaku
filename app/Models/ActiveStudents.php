<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActiveStudents extends Model
{
    use HasFactory;

    protected $table = 'active_students';

    protected $fillable = [
        "school_year",
        "generation",
        "major",
        "class",
        "student_id",
    ];

    public function student(): BelongsTo {
        return $this->BelongsTo(Students::class);
    }

}
