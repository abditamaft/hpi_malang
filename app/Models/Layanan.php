<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    // Beri tahu Laravel nama tabel aslinya
    protected $table = 'layanan';
    protected $guarded = [];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';
}
