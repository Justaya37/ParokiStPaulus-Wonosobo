<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lingkungans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_lingkungan', 20)->unique();
            $table->string('nama_lingkungan', 100);
            $table->string('nama_pelindung', 100);
            $table->string('wilayah', 100)->nullable()->index();
            $table->string('ketua_lingkungan', 150)->nullable();
            $table->string('kontak', 50)->nullable();
            $table->integer('jumlah_kk')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('stasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_stasi', 150)->unique();
            $table->string('nama_pelindung', 100);
            $table->string('lokasi_desa_kecamatan', 200);
            $table->decimal('jarak_dari_pusat_km', 5, 2)->nullable();
            $table->string('ketua_stasi', 150)->nullable();
            $table->string('kontak', 50)->nullable();
            $table->integer('kapasitas_umat')->nullable();
            $table->string('foto_gereja_stasi', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stasis');
        Schema::dropIfExists('lingkungans');
    }
};

