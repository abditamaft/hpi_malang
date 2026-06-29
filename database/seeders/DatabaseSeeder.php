<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun admin HPI
        User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin', // Ini username yang dipakai login
            'email' => 'admin@hpimalang.org', // Tetap diisi sebagai formalitas
            'password' => Hash::make('123'), // Password otomatis di-hash
        ]);
    }
}
