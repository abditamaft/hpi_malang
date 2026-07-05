<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Pramuwisata extends Model
{
    use HasFactory;
    // Beri tahu Laravel nama tabel aslinya
    protected $table = 'pramuwisata';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'slug',
        'nama_lengkap',
        'no_lisensi',
        'masa_berlaku_lisensi',
        'no_ktan',
        'masa_berlaku_ktan',
        'aktif_sejak',
        'foto_profil',
        'jenis_wisata_id',
        'jenis_wisata_en',
        'bahasa',
        'spesialisasi',
        'wilayah_operasi',
        'is_tersertifikasi',
        'bio_id',
        'bio_en',
        'status',
    ];

    protected $casts = [
        'masa_berlaku_lisensi' => 'date',
        'masa_berlaku_ktan' => 'date',
        'aktif_sejak' => 'date',
        'bahasa' => 'array',          
        'spesialisasi' => 'array',    
        'wilayah_operasi' => 'array', 
        'is_tersertifikasi' => 'boolean',
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Pramuwisata $item) {
            if (empty($item->slug)) {
                $item->slug = static::buatSlugUnik($item->nama_lengkap);
            }
        });
    }

    public static function buatSlugUnik(string $nama): string
    {
        $base = Str::slug($nama);
        $slug = $base;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function getBahasaLabelAttribute(): array
    {
        $locale = session('locale', 'id');

        return collect($this->bahasa ?? [])
            ->map(fn ($row) => $row[$locale] ?? $row['id'] ?? null)
            ->filter()
            ->values()
            ->all();
    }

    public function getSpesialisasiLabelAttribute(): array
    {
        $locale = session('locale', 'id');

        return collect($this->spesialisasi ?? [])
            ->map(fn ($row) => $row[$locale] ?? $row['id'] ?? null)
            ->filter()
            ->values()
            ->all();
    }

    public function getWilayahOperasiLabelAttribute(): string
    {
        return collect($this->wilayah_operasi ?? [])->filter()->implode(', ');
    }

    public function getBioAttribute(): ?string
    {
        return session('locale', 'id') === 'en' ? $this->bio_en : $this->bio_id;
    }

    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    public function scopeCariNama($query, ?string $keyword)
    {
        return $keyword
            ? $query->where('nama_lengkap', 'like', '%' . $keyword . '%')
            : $query;
    }
    public function scopeFilterBahasa($query, array $nilai)
    {
        if (empty($nilai)) {
            return $query;
        }

        return $query->where(function ($q) use ($nilai) {
            foreach ($nilai as $v) {
                $q->orWhereRaw(
                    "JSON_CONTAINS(JSON_EXTRACT(bahasa, '$[*].id'), JSON_QUOTE(?))",
                    [$v]
                );
            }
        });
    }

    public function scopeFilterSpesialisasi($query, array $nilai)
    {
        if (empty($nilai)) {
            return $query;
        }

        return $query->where(function ($q) use ($nilai) {
            foreach ($nilai as $v) {
                $q->orWhereRaw(
                    "JSON_CONTAINS(JSON_EXTRACT(spesialisasi, '$[*].id'), JSON_QUOTE(?))",
                    [$v]
                );
            }
        });
    }

    public static function daftarBahasaUnik()
    {
        return static::published()->pluck('bahasa')
            ->filter()
            ->flatten(1)
            ->filter(fn ($row) => !empty($row['id']))
            ->unique('id')
            ->values();
    }

    public static function daftarSpesialisasiUnik()
    {
        return static::published()->pluck('spesialisasi')
            ->filter()
            ->flatten(1)
            ->filter(fn ($row) => !empty($row['id']))
            ->unique('id')
            ->values();
    }

    public static function nilaiUnikDariJson(string $kolom, ?string $key = null): array
    {
        return static::query()->pluck($kolom)
            ->filter()
            ->flatten(1)
            ->map(fn ($row) => $key ? ($row[$key] ?? null) : $row)
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

}
