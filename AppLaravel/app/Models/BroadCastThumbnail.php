<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadCastThumbnail extends Model
{
    use HasFactory;
    protected $fillable=[
       'user_id','video_detail_id','title','description','img_name','channel_name','channel_avatar','status',
      ];
}
