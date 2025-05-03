<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentFrequency extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_details_id',
        'min_Sec',
        'max_Sec',
        'vsl_time_in_minutes'
    ];
}
