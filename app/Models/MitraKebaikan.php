<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraKebaikan extends Model
{
    protected $table = 'mitra_kebaikans';

    protected $fillable = [
        'nama_mitra',
        'logo',
        'link',
        'urutan',
    ];

    /**
     * Accessor untuk cek apakah mitra ini punya link atau tidak.
     */
    public function getHasLinkAttribute(): bool
    {
        return !empty($this->link);
    }
}