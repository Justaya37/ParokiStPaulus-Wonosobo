@extends('layouts.dashboard')

@section('title', 'Data Master: Profil Paroki')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: Profil Paroki</h1>
    <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
        Kelola identitas resmi, alamat, kontak, serta visi & misi Paroki Santo Paulus Wonosobo.
    </p>
</div>

<div class="card-paroki" style="max-width: 900px; padding: 2.25rem;">
    <form action="{{ route('master.profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="nama_paroki">Nama Paroki *</label>
                <input type="text" name="nama_paroki" id="nama_paroki" class="form-control" value="{{ old('nama_paroki', $profil->nama_paroki) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="keuskupan">Keuskupan Induk *</label>
                <input type="text" name="keuskupan" id="keuskupan" class="form-control" value="{{ old('keuskupan', $profil->keuskupan) }}" required>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="pelindung">Nama Pelindung *</label>
                <input type="text" name="pelindung" id="pelindung" class="form-control" value="{{ old('pelindung', $profil->pelindung) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="pesta_nama">Tanggal Pesta Nama</label>
                <input type="text" name="pesta_nama" id="pesta_nama" class="form-control" value="{{ old('pesta_nama', $profil->pesta_nama) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="alamat">Alamat Lengkap Gereja *</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="2" required>{{ old('alamat', $profil->alamat) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="telepon">Nomor Telepon Sekretariat</label>
                <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', $profil->telepon) }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email Resmi</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $profil->email) }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="whatsapp">Nomor WhatsApp Layanan</label>
                <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $profil->whatsapp) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="deskripsi_singkat">Deskripsi Singkat Paroki</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" class="form-control" rows="3">{{ old('deskripsi_singkat', $profil->deskripsi_singkat) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="sambutan_pastor">Sapaan Sambutan Pastor Paroki</label>
            <textarea name="sambutan_pastor" id="sambutan_pastor" class="form-control" rows="3">{{ old('sambutan_pastor', $profil->sambutan_pastor) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
            <div class="form-group">
                <label class="form-label" for="visi">Visi Pastoral Paroki</label>
                <textarea name="visi" id="visi" class="form-control" rows="4">{{ old('visi', $profil->visi) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="misi">Misi Pastoral Paroki</label>
                <textarea name="misi" id="misi" class="form-control" rows="4">{{ old('misi', $profil->misi) }}</textarea>
            </div>
        </div>

        <div style="text-align: right; margin-top: 1.5rem;">
            <button type="submit" class="btn-paroki btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Profil
            </button>
        </div>
    </form>
</div>
@endsection

