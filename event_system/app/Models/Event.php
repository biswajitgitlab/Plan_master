<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'location',
        'image_path',
        'created_by',
        'form_schema',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'form_schema' => 'array',
    ];

    public function getFormSchemaAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function quotas()
    {
        return $this->hasMany(EventQuota::class);
    }

    public function approvalBands()
    {
        return $this->hasMany(ApprovalBand::class)->orderBy('level_sequence');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
