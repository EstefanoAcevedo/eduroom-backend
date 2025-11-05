<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subjects extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    protected $fillable = [
        'subject_name',
        'career_id',
    ];

    /* A subject belongs to a career */
    public function career(): BelongsTo
    {
        return $this->belongsTo(Careers::class, 'career_id', 'career_id');
    }

    /* A subject has many enrollments */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollments::class, 'enrollment_id', 'enrollment_id');
    }
}
