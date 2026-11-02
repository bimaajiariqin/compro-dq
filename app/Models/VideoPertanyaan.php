<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoPertanyaan extends Model
{
    protected $table = 'videopertanyaan';

    protected $fillable = ['link', 'video_id', 'title', 'channel_name', 'thumbnail_url'];
}