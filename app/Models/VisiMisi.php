<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    // Beri tahu Laravel nama tabel pastinya
    protected $table = 'visi_misi';

    // Matikan fitur created_at karena tabel tidak punya kolom 'dibuat_pada'
    const CREATED_AT = null;

    // Arahkan fitur updated_at bawaan Laravel ke kolom 'diperbarui_pada'
    const UPDATED_AT = 'diperbarui_pada';

    // Izinkan semua kolom diisi
    protected $guarded = [];
}