<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commissions extends Model
{
    protected $table = 'commissions';
    protected $primaryKey = 'commission_id';
    protected $fillable = [
        'commission_name'
    ];
}
