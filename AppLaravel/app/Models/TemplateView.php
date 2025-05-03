<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateView extends Model
{
    protected $fillable = [
        'user_id',
        'template_id',
        'viewer_ip',
        'viewer_session',
        'user_agent',
        'is_charged'
    ];

    protected $casts = [
        'is_charged' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
