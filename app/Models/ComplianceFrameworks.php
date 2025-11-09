<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ComplianceRequirement;
class ComplianceFrameworks extends Model
{
       public function requirements()
       {
           return $this->hasMany(ComplianceRequirement::class, 'framework_id');
       }
}
