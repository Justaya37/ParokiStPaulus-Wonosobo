@extends('layouts.dashboard')

@section('title', 'Kategori Berita')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Kategori Berita Paroki</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kelola taksonomi pengelompokan artikel warta dan kegiatan.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahKategori').style.display='flex'">
        <i class="fa-solid fa-plus"></i> Tambah Kategori
    </button>
</div>

<!-- Tabel Kategori -->
<div class="card-paroki" style="padding: 0; overflow: hidden; max-width: 800px;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Slug URL</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Berita</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $k)
                    <tr>
                        <td><strong>{{ $k->nama_kategori }}</strong></td>
                        <td style="font-family: monospace; font-size: 0.8rem; color: var(--color-secondary);">{{ $k->slug }}</td>
                        <td>{{ $k->deskripsi ?? '-' }}</td>
                        <td><span class="badge-paroki badge-stasi">{{ $k->beritas_count }} Artikel</span></td>
                        <td style="text-align: right;">
                            <form action="{{ route('komsos.kategori.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem; color: var(--color-text-secondary);">
                            Belum ada kategori yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div id="modalTambahKategori" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 480px; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Tambah Kategori Berita</h3>
            <button onclick="document.getElementById('modalTambahKategori').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('komsos.kategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nama_kategori">Nama Kategori *</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required placeholder="Contoh: Liputan OMK">
            </div>

            <div class="form-group">
                <label class="form-label" for="deskripsi">Deskripsi Singkat</label>
                <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Penjelasan lingkup artikel...">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahKategori').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection

