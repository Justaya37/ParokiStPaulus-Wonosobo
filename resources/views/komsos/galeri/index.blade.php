@extends('layouts.dashboard')

@section('title', 'Kelola Album Galeri')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Album Galeri Dokumentasi</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kelola album dokumentasi foto kegiatan pastoral paroki, lingkungan, dan stasi.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahAlbum').style.display='flex'">
        <i class="fa-solid fa-folder-plus"></i> Buat Album Baru
    </button>
</div>

<!-- Grid Album -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
    @forelse($albums as $alb)
        <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span class="badge-paroki {{ $alb->status === 'published' ? 'badge-published' : 'badge-draft' }}">
                        {{ ucfirst($alb->status) }}
                    </span>
                    <span style="font-size: 0.8rem; color: var(--color-text-secondary); font-weight: 600;">
                        {{ $alb->fotos_count }} Foto
                    </span>
                </div>
                <h3 style="font-size: 1.25rem; color: var(--color-primary); margin-bottom: 0.5rem;">{{ $alb->judul }}</h3>
                <div style="font-size: 0.8rem; color: var(--color-text-secondary); margin-bottom: 0.75rem;">
                    Tanggal: {{ $alb->tanggal_kegiatan ? $alb->tanggal_kegiatan->format('d/m/Y') : '-' }}
                </div>
                @if($alb->deskripsi)
                    <p style="font-size: 0.875rem; color: var(--color-text-primary); line-height: 1.6; margin: 0;">
                        {{ Str::limit($alb->deskripsi, 80) }}
                    </p>
                @endif
            </div>

            <div style="border-top: 1px solid var(--color-border); padding-top: 1rem; margin-top: 1rem;">
                <a href="{{ route('komsos.galeri.show', $alb->id) }}" class="btn-paroki btn-primary btn-sm" style="width: 100%;">
                    <i class="fa-solid fa-images"></i> Buka & Unggah Foto
                </a>
            </div>
        </div>
    @empty
        <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
            <p style="color: var(--color-text-secondary); margin: 0;">Belum ada album galeri yang dibuat. Klik "Buat Album Baru".</p>
        </div>
    @endforelse
</div>

<div style="margin-top: 1.5rem;">
    {{ $albums->links() }}
</div>

<!-- Modal Tambah Album -->
<div id="modalTambahAlbum" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 500px; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Buat Album Galeri Baru</h3>
            <button onclick="document.getElementById('modalTambahAlbum').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('komsos.galeri.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="judul">Nama Album Kegiatan *</label>
                <input type="text" name="judul" id="judul" class="form-control" required placeholder="Contoh: Perayaan Natal Bersama Umat Stasi">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" for="tanggal_kegiatan">Tanggal Acara</label>
                    <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status Publikasi *</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="deskripsi">Deskripsi Singkat Acara</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Uraian kegiatan dokumentasi..."></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahAlbum').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Buat Album</button>
            </div>
        </form>
    </div>
</div>
@endsection

