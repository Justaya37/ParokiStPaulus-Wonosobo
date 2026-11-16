@extends('layouts.dashboard')

@section('title', 'Sunting Berita')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('komsos.berita.index') }}" style="color: var(--color-secondary); font-size: 0.875rem; text-decoration: none; display: inline-block; margin-bottom: 0.5rem;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Berita
    </a>
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Sunting Artikel Berita</h1>
</div>

<div class="card-paroki" style="max-width: 860px; padding: 2.25rem;">
    <form action="{{ route('komsos.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="judul">Judul Berita *</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="kategori_berita_id">Kategori Berita *</label>
                <select name="kategori_berita_id" id="kategori_berita_id" class="form-control" required>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_berita_id', $berita->kategori_berita_id) == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Status Publikasi *</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="draft" {{ old('status', $berita->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $berita->status) === 'published' ? 'selected' : '' }}>Published (Tampil di Website Publik)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="gambar_sampul">Ganti Foto Sampul Utama (Maks 4MB)</label>
            <input type="file" name="gambar_sampul" id="gambar_sampul" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label class="form-label" for="caption_gambar">Keterangan / Caption Foto Sampul</label>
            <input type="text" name="caption_gambar" id="caption_gambar" class="form-control" value="{{ old('caption_gambar', $berita->caption_gambar) }}">
        </div>

        <div class="form-group">
            <label class="form-label" for="ringkasan">Cuplikan Ringkasan</label>
            <textarea name="ringkasan" id="ringkasan" class="form-control" rows="2">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="isi">Isi Berita Lengkap *</label>
            <textarea name="isi" id="isi" class="form-control" rows="12" required>{{ old('isi', $berita->isi) }}</textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
            <a href="{{ route('komsos.berita.index') }}" class="btn-paroki btn-secondary">Batal</a>
            <button type="submit" class="btn-paroki btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

