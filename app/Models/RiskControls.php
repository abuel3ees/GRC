<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskControls extends Model
{
    protected $fillable = [
        'risk_id',
        'control_id',
        'effectiveness',
        'status',
    ];
}
