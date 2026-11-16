@extends('layouts.dashboard')

@section('title', 'Kelola Petugas Liturgi')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Petugas Pelayanan Liturgi</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Atur penugasan lektor, pemazmur, misdinar, organis, koor, dan prodiakon untuk jadwal misa.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahPetugas').style.display='flex'">
        <i class="fa-solid fa-plus"></i> Tambah Penugasan
    </button>
</div>

<!-- Tabel Penugasan -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Sesi Perayaan Ekaristi</th>
                    <th>Peran Liturgi</th>
                    <th>Nama Petugas / Tim</th>
                    <th>Kelompok Lingkungan</th>
                    <th>Kontak</th>
                    <th>Catatan</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $p)
                    <tr>
                        <td>
                            <strong>{{ $p->jadwalEkaristi->nama_perayaan ?? '-' }}</strong>
                            <div style="font-size: 0.775rem; color: var(--color-text-secondary);">
                                {{ $p->jadwalEkaristi->stasi ? $p->jadwalEkaristi->stasi->nama_stasi : 'Gereja Utama' }}
                                &bull; {{ $p->jadwalEkaristi->hari ?? '' }} ({{ date('H:i', strtotime($p->jadwalEkaristi->waktu_mulai ?? '00:00')) }} WIB)
                            </div>
                        </td>
                        <td>
                            <span class="badge-paroki badge-stasi">{{ $p->peran->nama_peran ?? '-' }}</span>
                        </td>
                        <td style="font-weight: 600;">{{ $p->nama_petugas }}</td>
                        <td>{{ $p->lingkungan->nama_lingkungan ?? '-' }}</td>
                        <td>{{ $p->kontak ?? '-' }}</td>
                        <td>{{ $p->catatan ?? '-' }}</td>
                        <td style="text-align: right;">
                            <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus penugasan petugas ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada penugasan petugas liturgi yang dicatat. Silakan klik "Tambah Penugasan".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $petugas->links() }}
</div>

<!-- Modal Tambah Petugas -->
<div id="modalTambahPetugas" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 550px; max-height: 90vh; overflow-y: auto; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Tambah Penugasan Liturgi</h3>
            <button onclick="document.getElementById('modalTambahPetugas').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('admin.petugas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="jadwal_ekaristi_id">Pilih Sesi Misa *</label>
                <select name="jadwal_ekaristi_id" id="jadwal_ekaristi_id" class="form-control" required>
                    <option value="">-- Pilih Sesi Perayaan Ekaristi --</option>
                    @foreach($jadwals as $jw)
                        <option value="{{ $jw->id }}">
                            {{ $jw->nama_perayaan }} &bull; {{ $jw->stasi ? $jw->stasi->nama_stasi : 'Gereja Utama' }} ({{ $jw->hari ?? $jw->tanggal?->format('d/m') }} {{ date('H:i', strtotime($jw->waktu_mulai)) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="liturgi_peran_id">Peran Pelayanan Liturgi *</label>
                <select name="liturgi_peran_id" id="liturgi_peran_id" class="form-control" required>
                    <option value="">-- Pilih Jenis Tugas --</option>
                    @foreach($perans as $pr)
                        <option value="{{ $pr->id }}">{{ $pr->nama_peran }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="nama_petugas">Nama Petugas / Tim Koor *</label>
                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" required placeholder="Contoh: Koor Lingkungan St. Ignatius / Bpk. Markus">
            </div>

            <div class="form-group">
                <label class="form-label" for="lingkungan_id">Asal Lingkungan (Jika Ditugaskan per Lingkungan)</label>
                <select name="lingkungan_id" id="lingkungan_id" class="form-control">
                    <option value="">-- Tidak Terikat Lingkungan Tertentu --</option>
                    @foreach($lingkungans as $l)
                        <option value="{{ $l->id }}">{{ $l->nomor_lingkungan }} - {{ $l->nama_lingkungan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="kontak">Kontak Narahubung</label>
                <input type="text" name="kontak" id="kontak" class="form-control" placeholder="08xxxxxxxxxx">
            </div>

            <div class="form-group">
                <label class="form-label" for="catatan">Catatan / Pakaian Seragam</label>
                <input type="text" name="catatan" id="catatan" class="form-control" placeholder="Contoh: Seragam Batik / Kumpul 30 menit sebelum misa">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahPetugas').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Simpan Penugasan</button>
            </div>
        </form>
    </div>
</div>
@endsection

