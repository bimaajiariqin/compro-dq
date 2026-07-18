<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'thumbnail',
        'nama_penerbit',
        'tanggal_terbit',
        'kategori',
        'filter_program',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];
}