<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teachers extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'number',
        'status',
        'user_id',
    ];

    public function subject(): BelongsTo {
        return $this->belongsTo(Subjects::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
