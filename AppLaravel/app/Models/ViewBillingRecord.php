<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewBillingRecord extends Model
{
    protected $fillable = [
        'user_id',
        'extra_views',
        'extra_views_cost',
        'status',
        'paid_at',
        'notes',
        'billing_period_start',
        'billing_period_end',
        'total_views',
        'description',
        'amount'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'extra_views_cost' => 'decimal:2',
        'billing_period_start' => 'datetime',
        'billing_period_end' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
