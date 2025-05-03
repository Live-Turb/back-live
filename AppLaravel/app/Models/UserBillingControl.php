<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBillingControl extends Model
{
    protected $fillable = [
        'user_id',
        'last_ip',
        'device_fingerprint',
        'pending_amount',
        'is_blocked',
        'block_reason',
        'last_billing_check'
    ];

    protected $casts = [
        'is_blocked' => 'boolean',
        'pending_amount' => 'decimal:2',
        'last_billing_check' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
