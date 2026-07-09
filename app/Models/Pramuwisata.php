<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'sertifikasi_tambahan',
        'bahasa',
        'bahasa_utama_id',
        'bahasa_utama_en',
        'jenis_wisata',
        'spesialisasi',
        'tipe_wisatawan',
        'keahlian_lain',
        'aktif_sejak',
        'asal_wisatawan',
        'foto_profil',
        'is_tersertifikasi',
        'bio_id',
        'bio_en',
        'wilayah_operasi',
        'status',
    ];

    public const FIELD_MULTI_DWIBAHASA = [
        'sertifikasi_tambahan',
        'bahasa',
        'jenis_wisata',
        'spesialisasi',
        'tipe_wisatawan',
        'keahlian_lain',
        'asal_wisatawan',
    ];

    protected $casts = [
        'masa_berlaku_lisensi' => 'date',
        'masa_berlaku_ktan' => 'date',
        'aktif_sejak' => 'integer',
        'sertifikasi_tambahan' => 'array',
        'bahasa' => 'array',
        'jenis_wisata' => 'array',
        'spesialisasi' => 'array',
        'tipe_wisatawan' => 'array',
        'keahlian_lain' => 'array',
        'asal_wisatawan' => 'array',
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

    protected function labelDariArrayDwibahasa(?array $data): array
    {
        $locale = session('locale', 'id');

        return collect($data ?? [])
            ->map(fn ($row) => $row[$locale] ?? $row['id'] ?? null)
            ->filter()
            ->values()
            ->all();
    }

    public function getSertifikasiTambahanLabelAttribute(): array
    {
        return $this->labelDariArrayDwibahasa($this->sertifikasi_tambahan);
    }

    public function getBahasaLabelAttribute(): array
    {
        return $this->labelDariArrayDwibahasa($this->bahasa);
    }

    public function getJenisWisataLabelAttribute(): array
    {
        return $this->labelDariArrayDwibahasa($this->jenis_wisata);
    }

    public function getSpesialisasiLabelAttribute(): array
    {
        return $this->labelDariArrayDwibahasa($this->spesialisasi);
    }

    public function getTipeWisatawanLabelAttribute(): array
    {
        return $this->labelDariArrayDwibahasa($this->tipe_wisatawan);
    }

    public function getKeahlianLainLabelAttribute(): array
    {
        return $this->labelDariArrayDwibahasa($this->keahlian_lain);
    }

    public function getAsalWisatawanLabelAttribute(): array
    {
        return $this->labelDariArrayDwibahasa($this->asal_wisatawan);
    }

    public function getBahasaUtamaLabelAttribute(): ?string
    {
        $locale = session('locale', 'id');

        return $locale === 'en'
            ? ($this->bahasa_utama_en ?: $this->bahasa_utama_id)
            : $this->bahasa_utama_id;
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

    public function scopeFilterKolomJson($query, string $kolom, array $nilai)
    {
        if (empty($nilai) || !in_array($kolom, self::FIELD_MULTI_DWIBAHASA, true)) {
            return $query;
        }

        return $query->where(function ($q) use ($kolom, $nilai) {
            foreach ($nilai as $v) {
                $q->orWhereRaw(
                    "JSON_CONTAINS(JSON_EXTRACT($kolom, '$[*].id'), JSON_QUOTE(?))",
                    [$v]
                );
            }
        });
    }

    public function scopeFilterBahasa($query, array $nilai)
    {
        return $query->filterKolomJson('bahasa', $nilai);
    }

    public function scopeFilterSpesialisasi($query, array $nilai)
    {
        return $query->filterKolomJson('spesialisasi', $nilai);
    }

    public static function daftarBahasaUnik()
    {
        return static::nilaiUnikObjekDwibahasa('bahasa');
    }

    public static function daftarSpesialisasiUnik()
    {
        return static::nilaiUnikObjekDwibahasa('spesialisasi');
    }

    public static function nilaiUnikObjekDwibahasa(string $kolom)
    {
        return static::published()->pluck($kolom)
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



    public function portofolio(): HasMany
    {
        return $this->hasMany(Portofolio::class)->latest('dibuat_pada');
    }
}
