<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_albums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->string('judul', 200);
            $table->string('slug', 220)->unique();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('cover_foto', 255)->nullable();
            $table->enum('status', ['draft', 'published'])->default('published')->index();
            $table->timestamps();
        });

        Schema::create('galeri_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galeri_album_id')->constrained('galeri_albums')->cascadeOnDelete();
            $table->string('file_path', 255);
            $table->string('caption', 255)->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_fotos');
        Schema::dropIfExists('galeri_albums');
    }
};

