<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    protected $table = 'web_settings';
    // TAMBAHKAN BARIS INI: Matikan fitur timestamp otomatis Laravel
    public $timestamps = false;
    protected $guarded = [];
}
