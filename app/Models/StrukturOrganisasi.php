<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    // Nama tabel di database
    protected $table = 'struktur_organisasi';

    // Sesuaikan nama kolom timestamps dengan database Mas
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $guarded = [];
}