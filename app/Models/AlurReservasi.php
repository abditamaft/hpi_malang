<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlurReservasi extends Model
{
    protected $table = 'alur_reservasi';
    // Menggunakan 'dibuat_pada' dan mematikan 'updated_at'
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = null;
    protected $guarded = [];
}