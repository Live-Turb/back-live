<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPalPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'duration',
        'uuid',
        'plan_key',
        'stripe_plan_key',
        'limit',
        'views_limit',
        'text1',
        'text2',
        'comment_limit',
        'step'
    ];
}
