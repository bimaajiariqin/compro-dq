<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    protected $table = 'laporan_keuangan';

    public $timestamps = false;

    protected $fillable = [
        'tahun',
        'link_dokumen',
    ];
}