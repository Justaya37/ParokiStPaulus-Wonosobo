@extends('layouts.dashboard')

@section('title', 'Tulis Berita Baru')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('komsos.berita.index') }}" style="color: var(--color-secondary); font-size: 0.875rem; text-decoration: none; display: inline-block; margin-bottom: 0.5rem;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Berita
    </a>
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Tulis Artikel Berita Baru</h1>
</div>

<div class="card-paroki" style="max-width: 860px; padding: 2.25rem;">
    <form action="{{ route('komsos.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label" for="judul">Judul Berita *</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required placeholder="Contoh: Perayaan Hari Raya Santo Paulus Rasul di Paroki Santo Paulus Wonosobo">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="kategori_berita_id">Kategori Berita *</label>
                <select name="kategori_berita_id" id="kategori_berita_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_berita_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Status Publikasi *</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Langsung Terbitkan (Published)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="gambar_sampul">Unggah Foto Sampul Utama (Maks 4MB)</label>
            <input type="file" name="gambar_sampul" id="gambar_sampul" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label class="form-label" for="caption_gambar">Keterangan / Caption Foto Sampul</label>
            <input type="text" name="caption_gambar" id="caption_gambar" class="form-control" value="{{ old('caption_gambar') }}" placeholder="Contoh: Suasana perarakan misa di depan gereja joglo">
        </div>

        <div class="form-group">
            <label class="form-label" for="ringkasan">Cuplikan Ringkasan (Lead Paragraph)</label>
            <textarea name="ringkasan" id="ringkasan" class="form-control" rows="2" placeholder="Satu atau dua kalimat ringkas isi berita...">{{ old('ringkasan') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="isi">Isi Berita Lengkap *</label>
            <textarea name="isi" id="isi" class="form-control" rows="12" required placeholder="Tuliskan berita lengkap...">{!! old('isi') !!}</textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
            <a href="{{ route('komsos.berita.index') }}" class="btn-paroki btn-secondary">Batal</a>
            <button type="submit" class="btn-paroki btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Berita
            </button>
        </div>
    </form>
</div>
@endsection

