<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
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

    /**
     * Route model binding pakai kolom ini, bukan 'id' —
     * jadi route('berita.show', $berita) otomatis menghasilkan /berita/judul-nya.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            if (empty($berita->slug)) {
                $berita->slug = static::generateUniqueSlug($berita->judul);
            }
        });

        static::updating(function (Berita $berita) {
            if ($berita->isDirty('judul') && ! $berita->isDirty('slug')) {
                $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}