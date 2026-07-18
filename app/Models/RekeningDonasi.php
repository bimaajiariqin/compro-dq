<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekeningDonasi extends Model
{
    protected $table = 'rekening_donasi';

    protected $fillable = [
        'kategori',
        'nama_bank',
        'logo',
        'no_rekening',
        'atas_nama',
    ];
}