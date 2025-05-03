<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadCastComment extends Model
{
    use HasFactory;

    protected $fillable = ['video_details_id', 'comment', 'platform'];
}
