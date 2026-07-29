<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPokok extends Model
{
    protected $table = 'program_pokok';

    protected $fillable = [
        'kategori_program',
        'judul',
        'deskripsi',
        'icon',
        'link',
    ];
}