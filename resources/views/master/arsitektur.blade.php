@extends('layouts.dashboard')

@section('title', 'Data Master: Filosofi & 20 Simbol Arsitektur')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: Filosofi Arsitektur & 20 Simbol</h1>
    <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
        Kelola narasi konsep Joglo Pangrawit Ceblokan, Goa Garba, serta rincian 20 simbol arsitektur gereja.
    </p>
</div>

<!-- Form Konsep Filosofis -->
<div class="card-paroki" style="margin-bottom: 2.5rem; padding: 2rem;">
    <h2 style="font-size: 1.35rem; color: var(--color-primary); margin-bottom: 1.25rem;">Konsep Arsitektur Utama</h2>
    <form action="{{ route('master.arsitektur.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="nama_arsitektur">Gaya Arsitektur *</label>
                <input type="text" name="nama_arsitektur" id="nama_arsitektur" class="form-control" value="{{ old('nama_arsitektur', $filosofi->nama_arsitektur) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="konsep_utama">Konsep Ruang Sakral *</label>
                <input type="text" name="konsep_utama" id="konsep_utama" class="form-control" value="{{ old('konsep_utama', $filosofi->konsep_utama) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="inkulturasi">Penjelasan Nilai Inkulturasi Jawa & Katolik *</label>
            <textarea name="inkulturasi" id="inkulturasi" class="form-control" rows="3" required>{{ old('inkulturasi', $filosofi->inkulturasi) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="deskripsi_lengkap">Deskripsi Mendalam Arsitektur Gereja *</label>
            <textarea name="deskripsi_lengkap" id="deskripsi_lengkap" class="form-control" rows="4" required>{{ old('deskripsi_lengkap', $filosofi->deskripsi_lengkap) }}</textarea>
        </div>

        <div style="text-align: right;">
            <button type="submit" class="btn-paroki btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Konsep Filosofis
            </button>
        </div>
    </form>
</div>

<!-- Daftar 20 Simbol Arsitektur -->
<div>
    <h2 style="font-size: 1.5rem; color: var(--color-primary); margin-bottom: 1.25rem;">Katalog 20 Simbol Arsitektur Gereja</h2>
    
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        @foreach($simbols as $s)
            <div class="card-paroki" style="padding: 1.5rem; border-left: 4px solid var(--color-accent);">
                <form action="{{ route('master.simbol.update', $s->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span style="font-weight: 700; color: var(--color-primary); font-size: 1.1rem;">
                            Simbol #{{ $s->nomor_simbol }}
                        </span>
                        <button type="submit" class="btn-paroki btn-secondary btn-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Simbol #{{ $s->nomor_simbol }}
                        </button>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Nama Simbol *</label>
                            <input type="text" name="nama_simbol" class="form-control" value="{{ $s->nama_simbol }}" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Posisi / Lokasi pada Gedung Gereja</label>
                            <input type="text" name="lokasi_pada_gereja" class="form-control" value="{{ $s->lokasi_pada_gereja }}" placeholder="Contoh: Sisi kiri mimbar altar">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Arti Filosofis Jawa *</label>
                            <textarea name="arti_filosofis" class="form-control" rows="2" required>{{ $s->arti_filosofis }}</textarea>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Nilai Teologis Kristiani *</label>
                            <textarea name="makna_teologis" class="form-control" rows="2" required>{{ $s->makna_teologis }}</textarea>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection

