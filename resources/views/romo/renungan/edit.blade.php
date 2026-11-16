@extends('layouts.dashboard')

@section('title', 'Edit Renungan Gembala')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('romo.renungan.index') }}" style="color: var(--color-secondary); font-size: 0.875rem; text-decoration: none; display: inline-block; margin-bottom: 0.5rem;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Renungan
    </a>
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Sunting Sapaan Gembala</h1>
</div>

<div class="card-paroki" style="max-width: 860px; padding: 2.25rem;">
    <form action="{{ route('romo.renungan.update', $renungan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="judul">Judul Renungan *</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $renungan->judul) }}" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="ayat_bacaan">Ayat / Perikop Kitab Suci</label>
                <input type="text" name="ayat_bacaan" id="ayat_bacaan" class="form-control" value="{{ old('ayat_bacaan', $renungan->ayat_bacaan) }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="tanggal_renungan">Tanggal Liturgi Renungan *</label>
                <input type="date" name="tanggal_renungan" id="tanggal_renungan" class="form-control" value="{{ old('tanggal_renungan', $renungan->tanggal_renungan ? $renungan->tanggal_renungan->format('Y-m-d') : date('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="isi">Isi Lengkap Renungan *</label>
            <textarea name="isi" id="isi" class="form-control" rows="12" required>{{ old('isi', $renungan->isi) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="status">Status Publikasi *</label>
            <select name="status" id="status" class="form-control" required>
                <option value="draft" {{ old('status', $renungan->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $renungan->status) === 'published' ? 'selected' : '' }}>Published (Tampil di Website Publik)</option>
            </select>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
            <a href="{{ route('romo.renungan.index') }}" class="btn-paroki btn-secondary">Batal</a>
            <button type="submit" class="btn-paroki btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

