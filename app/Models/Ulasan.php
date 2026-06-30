<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    // Beri tahu Laravel nama tabel aslinya
    protected $table = 'ulasan';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = null;
    protected $guarded = [];
}
