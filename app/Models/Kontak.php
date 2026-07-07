<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    // Memaksa Laravel menggunakan tabel 'kontak', bukan 'kontaks'
    protected $table = 'kontak';
    
    // Mengizinkan semua kolom untuk diisi
    protected $guarded = []; 

    // MATIKAN TIMESTAMPS LARAVEL
    // Karena tabel kontak hanya punya 'diperbarui_pada' dan sudah otomatis di-handle oleh MySQL
    public $timestamps = false;
}