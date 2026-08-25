<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalBand extends Model
{
    protected $fillable = [
        'event_id',
        'role_name',
        'level_sequence',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
