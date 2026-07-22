<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoKebaikan extends Model
{
    protected $fillable = ['link', 'video_id', 'title', 'channel_name', 'thumbnail_url'];
}