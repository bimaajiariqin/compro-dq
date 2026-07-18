<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'jabatan',
        'isi_testimoni',
        'foto_profil',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}   