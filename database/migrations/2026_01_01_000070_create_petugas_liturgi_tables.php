<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('liturgi_perans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peran', 100)->unique();
            $table->string('deskripsi', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('jadwal_petugas_liturgis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_ekaristi_id')->constrained('jadwal_ekaristis')->cascadeOnDelete();
            $table->foreignId('liturgi_peran_id')->constrained('liturgi_perans')->restrictOnDelete();
            $table->foreignId('lingkungan_id')->nullable()->constrained('lingkungans')->nullOnDelete();
            $table->string('nama_petugas', 150);
            $table->string('kontak', 50)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_petugas_liturgis');
        Schema::dropIfExists('liturgi_perans');
    }
};

