<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'riwayat';

    protected $fillable = [
        'tanggal',
        'judul',
        'deskripsi',
        'logo',
        'urutan',
    ];
}