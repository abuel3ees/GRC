<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ComplianceFrameworks;

class ComplianceRequirement extends Model
{
    protected $fillable = [
        'name',
        'description',
        'regulatory_body',
        'effective_date',
        'status',
    ];

    public function framework()
{
    return $this->belongsTo(ComplianceFrameworks::class, 'framework_id');
}
}