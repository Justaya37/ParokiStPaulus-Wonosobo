<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warta_parokis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->string('judul', 200);
            $table->string('edisi', 100);
            $table->date('tanggal_terbit')->index();
            $table->text('deskripsi')->nullable();
            $table->string('file_path', 255);
            $table->bigInteger('file_size_bytes')->nullable();
            $table->integer('download_count')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warta_parokis');
    }
};

