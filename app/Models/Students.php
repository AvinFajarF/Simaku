<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'students';

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, "user_id", "id");
    }

     // Relasi BelongsTo dengan model ActiveStudent
     public function activeStudent(): BelongsTo
     {
         return $this->belongsTo(ActiveStudents::class);
     }

}
