<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('keunggulan', function (Blueprint $table) {
            // Mengubah tipe kolom 'ikon' menjadi TEXT
            // Tambahkan nullable() agar datanya boleh kosong
            $table->text('ikon')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keunggulan', function (Blueprint $table) {
            // Kembalikan ke asalnya (VARCHAR 100) jika migration di-rollback
            $table->string('ikon', 100)->nullable()->change();
        });
    }
};