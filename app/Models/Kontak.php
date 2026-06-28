<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    // Memaksa Laravel menggunakan tabel 'kontak', bukan 'kontaks'
    protected $table = 'kontak';
    
    // (Opsional) Mengizinkan semua kolom untuk diisi nanti
    protected $guarded = []; 
}