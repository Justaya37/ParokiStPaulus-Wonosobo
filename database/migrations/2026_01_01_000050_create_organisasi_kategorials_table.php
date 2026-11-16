<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organisasi_kategorials', function (Blueprint $table) {
            $table->id();
            $table->string('kode_organisasi', 50)->unique();
            $table->string('nama_organisasi', 150);
            $table->text('deskripsi');
            $table->text('visi_misi')->nullable();
            $table->string('ketua', 150)->nullable();
            $table->string('pembina', 150)->nullable();
            $table->string('jadwal_kegiatan_rutin', 255)->nullable();
            $table->string('kontak', 50)->nullable();
            $table->string('logo', 255)->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organisasi_kategorials');
    }
};

