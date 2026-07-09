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
            'username' => 'abdikewer', // Ini username yang dipakai login
            'email' => 'admin@hpimalang.com', // Tetap diisi sebagai formalitas
            'password' => Hash::make('abdi1234'), // Password otomatis di-hash
        ]);
    }
}
