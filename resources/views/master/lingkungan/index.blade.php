@extends('layouts.dashboard')

@section('title', 'Data Master: 14 Lingkungan Paroki')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: 14 Lingkungan Paroki</h1>
    <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
        Kelola informasi ketua lingkungan, kontak, dan wilayah 14 lingkungan Paroki Santo Paulus Wonosobo.
    </p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.5rem;">
    @foreach($lingkungans as $l)
        <div class="card-paroki">
            <form action="{{ route('master.lingkungan.update', $l->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span class="badge-paroki badge-utama" style="font-size: 0.85rem;">{{ $l->nomor_lingkungan }}</span>
                    <button type="submit" class="btn-paroki btn-secondary btn-sm">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lingkungan *</label>
                    <input type="text" name="nama_lingkungan" class="form-control" value="{{ $l->nama_lingkungan }}" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="form-group">
                        <label class="form-label">Nama Pelindung *</label>
                        <input type="text" name="nama_pelindung" class="form-control" value="{{ $l->nama_pelindung }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Wilayah Pastoral</label>
                        <input type="text" name="wilayah" class="form-control" value="{{ $l->wilayah }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <div class="form-group">
                        <label class="form-label">Nama Ketua Lingkungan</label>
                        <input type="text" name="ketua_lingkungan" class="form-control" value="{{ $l->ketua_lingkungan }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kontak / WhatsApp</label>
                        <input type="text" name="kontak" class="form-control" value="{{ $l->kontak }}">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Cakupan Wilayah / Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ $l->keterangan }}">
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection

