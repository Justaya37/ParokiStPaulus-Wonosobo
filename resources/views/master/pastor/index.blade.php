@extends('layouts.dashboard')

@section('title', 'Data Master: Pastor Paroki')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: Pastor Paroki</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kelola data imam/pastor serta riwayat multi-periode masa penugasan di Paroki Santo Paulus Wonosobo.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahPastor').style.display='flex'">
        <i class="fa-solid fa-user-plus"></i> Tambah Data Pastor
    </button>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 1.75rem;">
    @forelse($pastors as $p)
        <div class="card-paroki">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                <div>
                    <span class="badge-paroki {{ $p->status_pelayanan === 'aktif' ? 'badge-published' : 'badge-utama' }}">
                        {{ ucfirst($p->status_pelayanan) }}
                    </span>
                    <h3 style="font-size: 1.25rem; margin-top: 0.35rem; color: var(--color-primary);">{{ $p->nama_lengkap }}</h3>
                    <div style="font-size: 0.8rem; color: var(--color-text-secondary);">Gelar: {{ $p->gelar_sebutan ?? 'Romo' }}</div>
                </div>
            </div>

            <!-- Riwayat Periode Penugasan -->
            <div style="background-color: var(--color-bg); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-border); margin-bottom: 1.25rem;">
                <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase; margin-bottom: 0.5rem;">
                    Periode Pelayanan di Paroki:
                </div>
                <ul style="list-style: none; font-size: 0.85rem; line-height: 1.7;">
                    @forelse($p->pelayanans as $pel)
                        <li style="display: flex; justify-content: space-between;">
                            <strong>{{ $pel->jabatan }}</strong>
                            <span>{{ $pel->tahun_mulai }} &ndash; {{ $pel->tahun_selesai ?? 'Sekarang' }}</span>
                        </li>
                    @empty
                        <li style="color: var(--color-text-secondary); font-style: italic;">Belum ada riwayat penugasan.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Form Tambah Periode Pelayanan -->
            <form action="{{ route('master.pastor.pelayanan.store', $p->id) }}" method="POST" style="border-top: 1px solid var(--color-border); padding-top: 1rem;">
                @csrf
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--color-primary); margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-clock-rotate-left"></i> Tambah Periode Pelayanan Baru:
                </div>
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <input type="text" name="jabatan" class="form-control" style="font-size: 0.825rem; padding: 0.4rem;" placeholder="Jabatan (cth: Pastor Rekan)" required>
                    <input type="number" name="tahun_mulai" class="form-control" style="font-size: 0.825rem; padding: 0.4rem;" placeholder="Mulai" min="1900" max="2100" required>
                    <input type="number" name="tahun_selesai" class="form-control" style="font-size: 0.825rem; padding: 0.4rem;" placeholder="Selesai (kosong=aktif)">
                </div>
                <button type="submit" class="btn-paroki btn-secondary btn-sm" style="width: 100%;">
                    <i class="fa-solid fa-plus"></i> Tambah Riwayat Jabatan
                </button>
            </form>
        </div>
    @empty
        <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
            <p style="color: var(--color-text-secondary); margin: 0;">Belum ada data pastor yang tersimpan. Klik "Tambah Data Pastor".</p>
        </div>
    @endforelse
</div>

<!-- Modal Tambah Pastor -->
<div id="modalTambahPastor" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Tambah Data Pastor</h3>
            <button onclick="document.getElementById('modalTambahPastor').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('master.pastor.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nama_lengkap">Nama Lengkap Imam *</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required placeholder="Contoh: Rm. Yohanes Pembaptis, Pr">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="gelar_sebutan">Gelar / Sapaan</label>
                    <input type="text" name="gelar_sebutan" id="gelar_sebutan" class="form-control" value="Romo">
                </div>
                <div class="form-group">
                    <label class="form-label" for="status_pelayanan">Status Pelayanan *</label>
                    <select name="status_pelayanan" id="status_pelayanan" class="form-control" required>
                        <option value="aktif">Aktif Bertugas</option>
                        <option value="purnatugas">Purnatugas / Emiritus</option>
                        <option value="pindah">Pindah Tugas</option>
                        <option value="almarhum">Almarhum</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="keterangan">Keterangan / Catatan Riwayat</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Catatan karya pastoral..."></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahPastor').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Simpan Pastor</button>
            </div>
        </form>
    </div>
</div>
@endsection

