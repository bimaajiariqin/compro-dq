<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeritaPenerimaManfaat extends Model
{
    use HasFactory;

    protected $table = 'cerita_penerima_manfaat';

    /**
     * Kategori program yang valid. Dipakai bersama oleh controller admin
     * (dropdown form) dan ProgramController (filter tampilan publik).
     */
    public const KATEGORI = ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan'];

    protected $fillable = [
        'nama',
        'jabatan',
        'kategori_program',
        'foto',
        'isi_cerita',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /** Hanya cerita yang aktif/ditampilkan di halaman publik. */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /** Filter berdasarkan kategori program (Pendidikan/Ekonomi/Dakwah/Kemanusiaan). */
    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori_program', $kategori);
    }

    /** Urutkan sesuai kolom `urutan`, lalu terbaru dahulu sebagai tie-breaker. */
    public function scopeTerurut($query)
    {
        return $query->orderBy('urutan')->orderByDesc('id');
    }
}