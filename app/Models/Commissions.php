<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commissions extends Model
{
    use HasFactory;

    protected $table = 'commissions';
    protected $primaryKey = 'commission_id';
    protected $fillable = [
        'commission_name'
    ];

    /* A commission has many enrollments */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollments::class, 'enrollment_id', 'enrollment_id');
    }
}
