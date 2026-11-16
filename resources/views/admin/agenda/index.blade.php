@extends('layouts.dashboard')

@section('title', 'Kelola Agenda Kegiatan')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Agenda Kegiatan Pastoral</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kalender acara retret, rapat dewan pastoral, perayaan sakramental, dan kegiatan umum paroki.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahAgenda').style.display='flex'">
        <i class="fa-solid fa-plus"></i> Tambah Agenda
    </button>
</div>

<!-- Tabel Agenda -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Kategori</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Penyelenggara</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendas as $ag)
                    <tr>
                        <td>
                            <strong>{{ $ag->nama_kegiatan }}</strong>
                        </td>
                        <td><span class="badge-paroki badge-stasi">{{ $ag->kategori_kegiatan }}</span></td>
                        <td>
                            {{ $ag->tanggal_mulai ? $ag->tanggal_mulai->format('d/m/Y') : '-' }}
                            @if($ag->tanggal_selesai && $ag->tanggal_selesai != $ag->tanggal_mulai)
                                &ndash; {{ $ag->tanggal_selesai->format('d/m/Y') }}
                            @endif
                        </td>
                        <td>{{ $ag->waktu_mulai ? date('H:i', strtotime($ag->waktu_mulai)) . ' WIB' : '-' }}</td>
                        <td>{{ $ag->lokasi }}</td>
                        <td>{{ $ag->penyelenggara }}</td>
                        <td>
                            @if($ag->is_aktif)
                                <span class="badge-paroki badge-published">Aktif</span>
                            @else
                                <span class="badge-paroki badge-draft">Non-Aktif</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <form action="{{ route('admin.agenda.destroy', $ag->id) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada agenda kegiatan yang dicatat. Klik "Tambah Agenda" untuk membuat baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $agendas->links() }}
</div>

<!-- Modal Tambah Agenda -->
<div id="modalTambahAgenda" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Tambah Agenda Kegiatan</h3>
            <button onclick="document.getElementById('modalTambahAgenda').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('admin.agenda.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nama_kegiatan">Nama Kegiatan *</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required placeholder="Contoh: Rekoleksi Adven Dewan Paroki">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="kategori_kegiatan">Kategori *</label>
                    <input type="text" name="kategori_kegiatan" id="kategori_kegiatan" class="form-control" value="Pastoral" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="penyelenggara">Penyelenggara *</label>
                    <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" required placeholder="Contoh: Panitia Natal / OMK">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="tanggal_mulai">Tanggal Mulai *</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="tanggal_selesai">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label" for="lokasi">Lokasi Kegiatan *</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required placeholder="Contoh: Gedung Pertemuan Paroki">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="deskripsi">Deskripsi Lengkap *</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required placeholder="Uraian agenda kegiatan..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="kontak_person">Narahubung (Kontak Person)</label>
                <input type="text" name="kontak_person" id="kontak_person" class="form-control" placeholder="08xxxxxxxxxx">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_aktif" value="1" checked>
                    <span style="font-size: 0.875rem; font-weight: 600;">Aktifkan Publikasi Agenda</span>
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahAgenda').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Simpan Agenda</button>
            </div>
        </form>
    </div>
</div>
@endsection

