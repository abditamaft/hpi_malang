<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portofolio extends Model
{
    protected $table = 'portofolio';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'pramuwisata_id',
        'url_gambar',
        'keterangan_id',
        'keterangan_en',
    ];

    public function pramuwisata(): BelongsTo
    {
        return $this->belongsTo(Pramuwisata::class);
    }

    public function getKeteranganAttribute(): ?string
    {
        return session('locale', 'id') === 'en'
            ? ($this->keterangan_en ?: $this->keterangan_id)
            : $this->keterangan_id;
    }
}
