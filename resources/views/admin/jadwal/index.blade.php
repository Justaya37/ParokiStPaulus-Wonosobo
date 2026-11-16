@extends('layouts.dashboard')

@section('title', 'Kelola Jadwal Ekaristi')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Jadwal Perayaan Ekaristi</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kelola jadwal misa harian, mingguan, dan hari raya untuk Gereja Utama dan 7 Stasi.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahJadwal').style.display='flex'">
        <i class="fa-solid fa-plus"></i> Tambah Jadwal Misa
    </button>
</div>

<!-- Tabel Jadwal -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Lokasi</th>
                    <th>Nama Perayaan</th>
                    <th>Tipe</th>
                    <th>Hari / Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Bahasa</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $j)
                    <tr>
                        <td>
                            @if($j->stasi_id && $j->stasi)
                                <span class="badge-paroki badge-stasi">{{ $j->stasi->nama_stasi }}</span>
                            @else
                                <span class="badge-paroki badge-utama">Gereja Utama</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $j->nama_perayaan }}</strong>
                            @if($j->keterangan)
                                <div style="font-size: 0.775rem; color: var(--color-text-secondary);">{{ $j->keterangan }}</div>
                            @endif
                        </td>
                        <td>
                            <span style="font-size: 0.775rem; text-transform: capitalize;">{{ $j->tipe_perayaan }}</span>
                        </td>
                        <td>
                            {{ $j->hari ?? ($j->tanggal ? $j->tanggal->format('d/m/Y') : '-') }}
                        </td>
                        <td style="font-weight: 600;">
                            {{ date('H:i', strtotime($j->waktu_mulai)) }} WIB
                        </td>
                        <td>{{ $j->bahasa }}</td>
                        <td>
                            @if($j->is_aktif)
                                <span class="badge-paroki badge-published">Aktif</span>
                            @else
                                <span class="badge-paroki badge-draft">Non-Aktif</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal misa ini? Seluruh penugasan petugas pada sesi ini juga akan terhapus.');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus Jadwal">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada jadwal Ekaristi yang ditambahkan. Silakan klik tombol "Tambah Jadwal Misa".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $jadwals->links() }}
</div>

<!-- Modal Tambah Jadwal -->
<div id="modalTambahJadwal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Tambah Jadwal Ekaristi</h3>
            <button onclick="document.getElementById('modalTambahJadwal').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nama_perayaan">Nama Perayaan Misa *</label>
                <input type="text" name="nama_perayaan" id="nama_perayaan" class="form-control" required placeholder="Contoh: Misa Mingguan Pagi">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="tipe_perayaan">Tipe Perayaan *</label>
                    <select name="tipe_perayaan" id="tipe_perayaan" class="form-control" required>
                        <option value="mingguan">Mingguan</option>
                        <option value="harian">Harian</option>
                        <option value="hari_raya">Hari Raya</option>
                        <option value="khusus">Khusus</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="stasi_id">Lokasi Gereja / Stasi</label>
                    <select name="stasi_id" id="stasi_id" class="form-control">
                        <option value="">Gereja Utama Santo Paulus Wonosobo</option>
                        @foreach($stasis as $st)
                            <option value="{{ $st->id }}">{{ $st->nama_stasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="hari">Hari (Rutin Mingguan)</label>
                    <select name="hari" id="hari" class="form-control">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tanggal">Tanggal (Khusus / Hari Raya)</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="waktu_mulai">Jam Mulai *</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="bahasa">Bahasa Pengantar *</label>
                    <input type="text" name="bahasa" id="bahasa" class="form-control" value="Bahasa Indonesia" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="keterangan">Keterangan Tambahan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Contoh: Misa Pertama Setiap Bulan / Misa Anak">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_aktif" value="1" checked>
                    <span style="font-size: 0.875rem; font-weight: 600;">Status Aktif (Tampilkan di Public Website)</span>
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahJadwal').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>
@endsection

