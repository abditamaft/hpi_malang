<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    // Beri tahu Laravel nama tabel aslinya
    protected $table = 'faq';
    // Beritahu Laravel nama kolom kustom untuk timestamps
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';
    protected $guarded = [];
}
