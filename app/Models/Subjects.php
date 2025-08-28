<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subjects extends Model
{
    protected $primaryKey = 'subject_id';
    protected $fillable = [
        'subject_name',
        'career_id',
    ];

    public function career(): BelongsTo
    {
        return $this->belongsTo(Careers::class, 'career_id', 'career_id');
    }
}
