<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ekaristis', function (Blueprint $table) {
            $table->id();
            // stasi_id NULL indicates Gereja Utama Paroki Santo Paulus Wonosobo
            $table->foreignId('stasi_id')->nullable()->constrained('stasis')->restrictOnDelete();
            $table->string('nama_perayaan', 150);
            $table->enum('tipe_perayaan', ['harian', 'mingguan', 'hari_raya', 'khusus'])->default('mingguan')->index();
            $table->string('lokasi_keterangan', 150)->nullable();
            $table->string('hari', 20)->nullable()->index();
            $table->date('tanggal')->nullable()->index();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai')->nullable();
            $table->string('bahasa', 50)->default('Bahasa Indonesia');
            $table->text('keterangan')->nullable();
            $table->boolean('is_aktif')->default(true)->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ekaristis');
    }
};

