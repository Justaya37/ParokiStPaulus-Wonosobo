<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_beritas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100);
            $table->string('slug', 120)->unique();
            $table->string('deskripsi', 255)->nullable();
            $table->integer('urutan')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_berita_id')->constrained('kategori_beritas')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->string('judul', 255);
            $table->string('slug', 280)->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('isi');
            $table->string('gambar_sampul', 255)->nullable();
            $table->string('caption_gambar', 255)->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
        Schema::dropIfExists('kategori_beritas');
    }
};

