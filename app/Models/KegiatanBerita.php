<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class KegiatanBerita extends Model
{
    // Beri tahu Laravel nama tabel aslinya
    use HasFactory;
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'kegiatan_berita';
    
    protected $fillable = [
        'tipe',
        'slug',
        'tanggal_kegiatan',
        'lokasi_kegiatan',
        'url_gambar',
        'url_sumber',
        'judul_id',
        'judul_en',
        'kategori_id',
        'kategori_en',
        'deskripsi_singkat_id',
        'deskripsi_singkat_en',
        'isi_id',
        'isi_en',
        'status',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (KegiatanBerita $item) {
            if (empty($item->slug)) {
                $item->slug = static::buatSlugUnik($item->judul_id ?: $item->judul_en);
            }
        });
    }

    public static function buatSlugUnik(string $judul): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    public function getJudulAttribute(): string
    {
        return app()->getLocale() === 'en' ? $this->judul_en : $this->judul_id;
    }

    public function getKategoriAttribute(): ?string
    {
        return app()->getLocale() === 'en' ? $this->kategori_en : $this->kategori_id;
    }

    public function getDeskripsiSingkatAttribute(): ?string
    {
        return app()->getLocale() === 'en' ? $this->deskripsi_singkat_en : $this->deskripsi_singkat_id;
    }

    public function getIsiAttribute(): ?string
    {
        return app()->getLocale() === 'en' ? $this->isi_en : $this->isi_id;
    }


    public function scopeKegiatan($query)
    {
        return $query->where('tipe', 'kegiatan');
    }

    public function scopeBerita($query)
    {
        return $query->where('tipe', 'berita');
    }

    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    public function scopeMendatang($query)
    {
        return $query->where('tanggal_kegiatan', '>=', now()->toDateString());
    }

}
