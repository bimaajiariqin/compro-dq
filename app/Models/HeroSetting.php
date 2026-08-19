<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSetting extends Model
{
    protected $fillable = [
        'foto',
        'eyebrow_id',
        'eyebrow_en',
        'judul_id',
        'judul_en',
        'subjudul_id',
        'subjudul_en',
    ];
}