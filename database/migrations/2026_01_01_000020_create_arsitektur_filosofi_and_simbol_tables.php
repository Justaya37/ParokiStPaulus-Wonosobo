<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsitektur_filosofis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_arsitektur', 150)->default('Joglo Pangrawit Ceblokan');
            $table->string('konsep_utama', 150)->default('Garbha Griha / Goa Garba');
            $table->text('inkulturasi');
            $table->longText('deskripsi_lengkap');
            $table->string('foto_arsitektur', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('arsitektur_simbols', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_simbol')->unique();
            $table->string('nama_simbol', 150);
            $table->text('arti_filosofis');
            $table->text('makna_teologis');
            $table->string('lokasi_pada_gereja', 150)->nullable();
            $table->string('foto_simbol', 255)->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsitektur_simbols');
        Schema::dropIfExists('arsitektur_filosofis');
    }
};

