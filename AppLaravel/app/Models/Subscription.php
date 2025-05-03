<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'paypal_id',
        'stripe_id',
        'mercadopago_id',
        'status',
        'plan_id',
        'start_time',
        'expire_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function paypalPlan()
    {
        return $this->belongsTo(PayPalPlan::class, 'plan_id', 'id');
    }
}
