<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Careers extends Model
{
    protected $primaryKey = 'career_id';
    protected $fillable = [
        'career_name',
        'career_alias',
    ];

    public function subjects(): HasMany
    {
        return $this->hasMany(Subjects::class, 'career_id', 'career_id');
    }
}
