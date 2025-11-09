<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risks extends Model
{
    public function controls() {
    return $this->belongsToMany(Controls::class, 'risk_controls');
}
public function mitigations() {
    return $this->hasMany(Mitigations::class);
}
public function owner() {
    return $this->belongsTo(User::class, 'owner_id');
}
}
