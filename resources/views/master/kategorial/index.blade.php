@extends('layouts.dashboard')

@section('title', 'Data Master: Organisasi Kategorial')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: Organisasi Kategorial</h1>
    <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
        Kelola profil 7 kelompok kategorial resmi: OMK, WKRI, PWK Santa Monika, Legio Mariae, PDPKK, CFM, dan ME.
    </p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 1.5rem;">
    @foreach($kategorials as $k)
        <div class="card-paroki">
            <form action="{{ route('master.kategorial.update', $k->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span class="badge-paroki badge-utama" style="font-size: 0.85rem;">{{ $k->kode_organisasi }}</span>
                    <button type="submit" class="btn-paroki btn-secondary btn-sm">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap Organisasi *</label>
                    <input type="text" name="nama_organisasi" class="form-control" value="{{ $k->nama_organisasi }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Pelayanan *</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required>{{ $k->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Visi & Misi Kategorial</label>
                    <textarea name="visi_misi" class="form-control" rows="2">{{ $k->visi_misi }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Ketua / Koordinator</label>
                        <input type="text" name="ketua" class="form-control" value="{{ $k->ketua }}">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Kontak / Narahubung</label>
                        <input type="text" name="kontak" class="form-control" value="{{ $k->kontak }}">
                    </div>
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection

