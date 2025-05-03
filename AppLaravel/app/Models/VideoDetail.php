<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'user_id',
        'template_type',
        'details_video_title',
        'details_video_description',
        'details_video_shortcode',
        'details_video_minnum',
        'details_video_maxnum',
    ];

    public function videoThumbnail()
    {
        return $this->hasMany(BroadCastThumbnail::class, 'video_detail_id', 'id');
    }

    public function videoComment()
    {
        return $this->hasMany(BroadCastComment::class, 'video_details_id', 'id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
