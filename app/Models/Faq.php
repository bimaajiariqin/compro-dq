<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'kategori_program',
        'pertanyaan',
        'jawaban',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public const KATEGORI = ['Dakwah', 'Pendidikan', 'Ekonomi', 'Kemanusiaan'];

    /**
     * Hanya FAQ yang aktif/dipublikasikan.
     */
    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Filter berdasarkan kategori program (Dakwah, Pendidikan, Ekonomi, Kemanusiaan).
     */
    public function scopeKategori(Builder $query, string $kategori): Builder
    {
        return $query->where('kategori_program', $kategori);
    }

    /**
     * Urutkan berdasarkan kolom urutan, lalu id sebagai tie-breaker.
     */
    public function scopeTerurut(Builder $query): Builder
    {
        return $query->orderBy('urutan')->orderBy('id');
    }
}