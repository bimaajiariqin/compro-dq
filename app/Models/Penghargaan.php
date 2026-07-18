<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    protected $table = 'penghargaan';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'tanggal_terbit',
        'tahun',
        'dokumen',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'created_at'     => 'datetime',
    ];
}