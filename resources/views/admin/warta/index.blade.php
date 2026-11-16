@extends('layouts.dashboard')

@section('title', 'Kelola Warta Paroki')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Warta Paroki Digital (PDF)</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Unggah dan kelola publikasi berkas digital Warta Paroki mingguan untuk umat.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalUnggahWarta').style.display='flex'">
        <i class="fa-solid fa-cloud-arrow-up"></i> Unggah Warta Paroki
    </button>
</div>

<!-- Tabel Warta -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Judul Warta</th>
                    <th>Edisi</th>
                    <th>Tanggal Terbit</th>
                    <th>Ukuran File</th>
                    <th>Total Unduhan</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wartas as $w)
                    <tr>
                        <td>
                            <strong>{{ $w->judul }}</strong>
                            @if($w->deskripsi)
                                <div style="font-size: 0.775rem; color: var(--color-text-secondary);">{{ Str::limit($w->deskripsi, 60) }}</div>
                            @endif
                        </td>
                        <td><span class="badge-paroki badge-utama">{{ $w->edisi }}</span></td>
                        <td>{{ $w->tanggal_terbit ? $w->tanggal_terbit->format('d/m/Y') : '-' }}</td>
                        <td>{{ $w->formatted_file_size }}</td>
                        <td>{{ number_format($w->download_count) }} kali</td>
                        <td>
                            @if($w->status === 'published')
                                <span class="badge-paroki badge-published">Published</span>
                            @else
                                <span class="badge-paroki badge-draft">Draft</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('public.warta.download', $w->id) }}" class="btn-paroki btn-secondary btn-sm" title="Unduh File"><i class="fa-solid fa-download"></i></a>
                            <form action="{{ route('admin.warta.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Hapus berkas warta paroki ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada berkas warta paroki yang diunggah. Klik "Unggah Warta Paroki".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $wartas->links() }}
</div>

<!-- Modal Unggah Warta -->
<div id="modalUnggahWarta" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 550px; max-height: 90vh; overflow-y: auto; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Unggah Warta Paroki Baru</h3>
            <button onclick="document.getElementById('modalUnggahWarta').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('admin.warta.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label" for="judul">Judul Warta *</label>
                <input type="text" name="judul" id="judul" class="form-control" required placeholder="Contoh: Warta Paroki Santo Paulus Wonosobo">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="edisi">Edisi / Minggu Liturgi *</label>
                    <input type="text" name="edisi" id="edisi" class="form-control" required placeholder="Contoh: Minggu Biasa XXXII - Th. B">
                </div>

                <div class="form-group">
                    <label class="form-label" for="tanggal_terbit">Tanggal Terbit *</label>
                    <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="file_pdf">Pilih Berkas PDF Warta * (Maks 15 MB)</label>
                <input type="file" name="file_pdf" id="file_pdf" class="form-control" accept="application/pdf" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="deskripsi">Deskripsi Singkat / Catatan Edisi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Rangkuman pengumuman utama edisi ini..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Status Publikasi *</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="published">Langsung Terbitkan (Published)</option>
                    <option value="draft">Simpan Draft Terlebih Dahulu</option>
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalUnggahWarta').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Unggah & Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

