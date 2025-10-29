<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollments extends Model
{
    use HasFactory;

    protected $table = 'enrollments';
    protected $primaryKey = 'enrollment_id';
    protected $fillable = [
        'enrollment_academic_year',
        'enrollment_is_approved',
        'user_id',
        'subject_id',
        'commission_id'
    ];

    /* An enrollment belongs to a user */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /* An enrollment belongs to a subject */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subjects::class, 'subject_id', 'subject_id');
    }

    /* An enrollment belongs to a commission */
    public function commission(): BelongsTo
    {
        return $this->belongsTo(Commissions::class, 'commission_id', 'commission_id');
    }

    /* An enrollment has many attendances */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendances::class, 'enrollment_id', 'enrollment_id');
    }
}
