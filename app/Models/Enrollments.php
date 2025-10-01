<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'enrollment_id';
    protected $fillable = [
        'enrollment_academic_year',
        'enrollment_is_approved',
        'user_id',
        'subject_id',
        'commission_id'
    ];
}
