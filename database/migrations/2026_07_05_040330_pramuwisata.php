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
        Schema::create('pramuwisata', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama_lengkap');
            $table->string('no_lisensi')->nullable();
            $table->date('masa_berlaku_lisensi')->nullable();
            $table->string('no_ktan')->nullable();
            $table->date('masa_berlaku_ktan')->nullable();
            $table->date('aktif_sejak')->nullable();
            $table->string('foto_profil')->nullable();

            $table->string('jenis_wisata_id')->nullable();
            $table->string('jenis_wisata_en')->nullable();

            $table->json('bahasa')->nullable();
            $table->json('spesialisasi')->nullable();
            $table->json('wilayah_operasi')->nullable();

            $table->boolean('is_tersertifikasi')->default(false);
            $table->text('bio_id')->nullable();
            $table->text('bio_en')->nullable();

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
        Schema::dropIfExists('pramuwisata');
    }
};
