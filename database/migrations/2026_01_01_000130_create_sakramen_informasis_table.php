<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sakramen_informasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sakramen', 50)->unique();
            $table->string('nama_sakramen', 150);
            $table->text('deskripsi_teologis');
            $table->longText('persyaratan');
            $table->longText('prosedur_pelayanan');
            $table->text('jadwal_pelayanan_rutin')->nullable();
            $table->string('kontak_layanan', 100)->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sakramen_informasis');
    }
};

