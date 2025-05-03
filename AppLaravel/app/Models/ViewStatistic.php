<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewStatistic extends Model
{
    protected $fillable = [
        'template_id',
        'user_id',
        'viewer_ip',
        'viewer_session',
        'country',
        'city',
        'device_type',
        'browser',
        'os',
        'referrer_domain',
        'referrer_url',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'view_duration',
        'is_unique'
    ];

    protected $casts = [
        'is_unique' => 'boolean',
        'view_duration' => 'integer',
        'template_id' => 'integer'
    ];

    protected $attributes = [
        'template_id' => null
    ];

    public function template()
    {
        return $this->belongsTo(VideoDetail::class, 'template_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
