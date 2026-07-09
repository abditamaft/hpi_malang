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
        Schema::dropIfExists('portofolio');
        Schema::create('portofolio', function (Blueprint $table) {
            // $table->id() otomatis membuat kolom 'id' bertipe BIGINT UNSIGNED
            $table->id();

            // foreignId() otomatis bertipe BIGINT UNSIGNED agar cocok dengan id pramuwisata
            // constrained() memastikan kalau pramuwisata dihapus, portofolionya ikut terhapus
            $table->foreignId('pramuwisata_id')
                  ->constrained('pramuwisata')
                  ->onDelete('cascade');

            $table->string('url_gambar');
            $table->string('keterangan_id')->nullable();
            $table->string('keterangan_en')->nullable();

            // Menyesuaikan format timestamp bahasa Indonesia seperti tabel lainnya
            $table->timestamp('dibuat_pada')->useCurrent()->nullable();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio');
    }
};