<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
     protected $fillable = [
        'assessment_id',
        'user_id',
        'score',
        'status',
        'remarks',
    ];
}
