<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CyberRisk extends Model
{
  protected $fillable = [
        'code', 'title', 'risk_statement', 'cause', 'consequence',
        'existing_control', 'likelihood', 'impact', 'score',
        'residual_level', 'mitigation_plan'
    ];
}
