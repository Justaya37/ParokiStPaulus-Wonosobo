@extends('layouts.dashboard')

@section('title', 'Data Master: Sejarah Paroki')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: Sejarah Paroki</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kelola peristiwa dan tonggak linimasa sejarah berdirinya Paroki Santo Paulus Wonosobo.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahSejarah').style.display='flex'">
        <i class="fa-solid fa-plus"></i> Tambah Peristiwa Sejarah
    </button>
</div>

<!-- Tabel Linimasa Sejarah -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th style="width: 120px;">Tahun</th>
                    <th>Judul Peristiwa</th>
                    <th>Uraian Deskripsi</th>
                    <th style="width: 80px;">Urutan</th>
                    <th style="text-align: right; width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sejarahs as $s)
                    <tr>
                        <td style="font-weight: 700; color: var(--color-secondary);">{{ $s->tahun }}</td>
                        <td><strong>{{ $s->judul_peristiwa }}</strong></td>
                        <td style="font-size: 0.875rem; color: var(--color-text-primary);">{{ $s->deskripsi }}</td>
                        <td>{{ $s->urutan }}</td>
                        <td style="text-align: right;">
                            <form action="{{ route('master.sejarah.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus peristiwa sejarah ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada catatan linimasa sejarah yang ditambahkan. Klik "Tambah Peristiwa Sejarah".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Sejarah -->
<div id="modalTambahSejarah" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 550px; max-height: 90vh; overflow-y: auto; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Tambah Peristiwa Sejarah</h3>
            <button onclick="document.getElementById('modalTambahSejarah').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('master.sejarah.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="tahun">Tahun / Periode *</label>
                    <input type="text" name="tahun" id="tahun" class="form-control" required placeholder="Contoh: 1965 atau 1980-1985">
                </div>
                <div class="form-group">
                    <label class="form-label" for="urutan">Nomor Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" value="0">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="judul_peristiwa">Judul Peristiwa *</label>
                <input type="text" name="judul_peristiwa" id="judul_peristiwa" class="form-control" required placeholder="Contoh: Pemberkatan Gereja Joglo St. Paulus">
            </div>

            <div class="form-group">
                <label class="form-label" for="deskripsi">Uraian Sejarah *</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required placeholder="Penjelasan peristiwa sejarah paroki..."></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahSejarah').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Simpan Sejarah</button>
            </div>
        </form>
    </div>
</div>
@endsection

