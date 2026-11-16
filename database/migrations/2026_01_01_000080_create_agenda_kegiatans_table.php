<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_kegiatan', 200);
            $table->string('slug', 220)->unique();
            $table->string('kategori_kegiatan', 100)->default('Pastoral');
            $table->date('tanggal_mulai')->index();
            $table->date('tanggal_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('lokasi', 200);
            $table->text('deskripsi');
            $table->string('penyelenggara', 150);
            $table->string('kontak_person', 100)->nullable();
            $table->string('gambar_poster', 255)->nullable();
            $table->boolean('is_aktif')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_kegiatans');
    }
};

