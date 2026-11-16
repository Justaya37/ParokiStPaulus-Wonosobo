<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_paroki', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paroki', 150)->default('Paroki Santo Paulus Wonosobo');
            $table->string('keuskupan', 150)->default('Keuskupan Purwokerto');
            $table->string('pelindung', 100)->default('Santo Paulus Rasul');
            $table->string('pesta_nama', 100)->nullable()->default('29 Juni');
            $table->text('alamat');
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('telepon', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->text('google_maps_embed')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('deskripsi_singkat')->nullable();
            $table->text('sambutan_pastor')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('foto_gereja_utama', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('sejarah_parokis', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 30)->index();
            $table->string('judul_peristiwa', 200);
            $table->text('deskripsi');
            $table->string('foto', 255)->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarah_parokis');
        Schema::dropIfExists('profil_paroki');
    }
};

