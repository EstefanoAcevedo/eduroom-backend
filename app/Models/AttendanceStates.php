<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttendanceStates extends Model
{
    use HasFactory;

    protected $table = 'attendance_states';
    protected $primaryKey = 'attendance_state_id';
    protected $fillable = [
        'attendance_state_name',
        'attendance_state_value',
    ];

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendances::class, 'attendance_state_id', 'attendance_state_id');
    }
}
