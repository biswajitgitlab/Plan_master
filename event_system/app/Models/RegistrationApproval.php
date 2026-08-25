<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationApproval extends Model
{
    protected $fillable = [
        'registration_id',
        'approver_id',
        'status',
        'comments',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
