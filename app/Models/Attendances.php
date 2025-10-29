<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendances extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id';
    protected $fillable = [
        'attendance_date',
        'attendance_is_justified',
        'attendance_state_id',
        'enrollment_id',
    ];

    /* An attendance belongs to an attendance state */
    public function attendanceState(): BelongsTo
    {
        return $this->belongsTo(AttendanceStates::class, 'attendance_state_id', 'attendance_state_id');
    }

    /* An attendance belongs to an enrollment */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollments::class, 'enrollment_id', 'enrollment_id');
    }
}
