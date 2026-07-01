<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keunggulan extends Model
{
    // Beri tahu Laravel nama tabel aslinya
    protected $table = 'keunggulan';
    // Beri tahu Laravel untuk pakai 'dibuat_pada' saat data baru masuk
    const CREATED_AT = 'dibuat_pada';
    
    // Matikan paksa fitur updated_at karena tabelnya tidak punya
    const UPDATED_AT = null;
    protected $guarded = [];
}
