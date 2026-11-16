<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pastors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 150);
            $table->string('gelar_sebutan', 50)->nullable()->default('Romo');
            $table->date('tahbisan_date')->nullable();
            $table->enum('status_pelayanan', ['aktif', 'purnatugas', 'almarhum', 'pindah'])->default('aktif')->index();
            $table->string('foto', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('pastor_pelayanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pastor_id')->constrained('pastors')->cascadeOnDelete();
            $table->string('jabatan', 100);
            $table->smallInteger('tahun_mulai');
            $table->smallInteger('tahun_selesai')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pastor_pelayanans');
        Schema::dropIfExists('pastors');
    }
};

