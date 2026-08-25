<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventQuota extends Model
{
    protected $fillable = [
        'event_id',
        'role_name',
        'quota_limit',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
