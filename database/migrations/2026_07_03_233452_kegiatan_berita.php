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
        Schema::create('kegiatan_berita', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['kegiatan', 'berita'])->default('berita')->index();
            $table->string('slug')->unique();
            $table->date('tanggal_kegiatan')->nullable()->index();
            $table->string('lokasi_kegiatan')->nullable();
            $table->string('url_gambar')->nullable();
            $table->string('url_sumber')->nullable();
            $table->string('judul_id');
            $table->string('judul_en');
            $table->string('kategori_id')->nullable();
            $table->string('kategori_en')->nullable();
            $table->text('deskripsi_singkat_id')->nullable();
            $table->text('deskripsi_singkat_en')->nullable();
            $table->longText('isi_id')->nullable();
            $table->longText('isi_en')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_berita');
    }
};
