@extends('layouts.dashboard')

@section('title', 'Data Master: 7 Stasi Paroki')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: 7 Stasi Paroki</h1>
    <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
        Kelola informasi gereja stasi, lokasi desa/kecamatan, jarak tempuh, dan kapasitas umat 7 Stasi Paroki.
    </p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.5rem;">
    @foreach($stasis as $s)
        <div class="card-paroki">
            <form action="{{ route('master.stasi.update', $s->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span class="badge-paroki badge-stasi" style="font-size: 0.85rem;">Stasi Paroki</span>
                    <button type="submit" class="btn-paroki btn-secondary btn-sm">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Stasi *</label>
                    <input type="text" name="nama_stasi" class="form-control" value="{{ $s->nama_stasi }}" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="form-group">
                        <label class="form-label">Nama Pelindung *</label>
                        <input type="text" name="nama_pelindung" class="form-control" value="{{ $s->nama_pelindung }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jarak dari Paroki (km)</label>
                        <input type="number" step="0.1" name="jarak_dari_pusat_km" class="form-control" value="{{ $s->jarak_dari_pusat_km }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Lokasi Desa & Kecamatan *</label>
                    <input type="text" name="lokasi_desa_kecamatan" class="form-control" value="{{ $s->lokasi_desa_kecamatan }}" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="form-group">
                        <label class="form-label">Nama Ketua Stasi</label>
                        <input type="text" name="ketua_stasi" class="form-control" value="{{ $s->ketua_stasi }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kapasitas Umat</label>
                        <input type="number" name="kapasitas_umat" class="form-control" value="{{ $s->kapasitas_umat }}">
                    </div>
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection

