<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Risks;
class Controls extends Model
{
    public function risk()
{
    return $this->belongsTo(Risks::class);
}
}