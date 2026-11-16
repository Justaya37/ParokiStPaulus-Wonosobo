@extends('layouts.dashboard')

@section('title', 'Detail Album: ' . $album->judul)

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('komsos.galeri.index') }}" style="color: var(--color-secondary); font-size: 0.875rem; text-decoration: none; display: inline-block; margin-bottom: 0.5rem;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Album
    </a>
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">{{ $album->judul }}</h1>
            <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
                Tanggal: <strong>{{ $album->tanggal_kegiatan ? $album->tanggal_kegiatan->format('d/m/Y') : '-' }}</strong> &bull; Total {{ $album->fotos->count() }} Foto
            </p>
        </div>
        <button class="btn-paroki btn-primary" onclick="document.getElementById('modalUploadFoto').style.display='flex'">
            <i class="fa-solid fa-cloud-arrow-up"></i> Unggah Foto ke Album Ini
        </button>
    </div>
</div>

<!-- Grid Foto dalam Album -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
    @forelse($album->fotos as $f)
        <div class="card-paroki" style="padding: 0.75rem;">
            <div style="height: 180px; background-color: var(--color-surface); border-radius: var(--radius-md); overflow: hidden; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: center;">
                @if(Storage::disk('public')->exists($f->file_path))
                    <img src="{{ asset('storage/' . $f->file_path) }}" alt="{{ $f->caption ?? 'Foto' }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i class="fa-solid fa-image" style="font-size: 2.5rem; color: var(--color-text-secondary); opacity: 0.4;"></i>
                @endif
            </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem;">
                <div style="font-size: 0.825rem; color: var(--color-text-primary); line-height: 1.4;">
                    {{ $f->caption ?? 'Foto #' . $f->urutan }}
                </div>
                <form action="{{ route('komsos.galeri.foto.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-paroki btn-danger btn-sm" style="padding: 0.2rem 0.5rem;" title="Hapus Foto">
                        <i class="fa-solid fa-trash" style="font-size: 0.75rem;"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
            <i class="fa-solid fa-images" style="font-size: 3rem; color: var(--color-secondary); opacity: 0.4; margin-bottom: 1rem;"></i>
            <p style="color: var(--color-text-secondary); margin: 0;">Album ini belum memiliki foto. Klik tombol "Unggah Foto ke Album Ini".</p>
        </div>
    @endforelse
</div>

<!-- Modal Upload Foto -->
<div id="modalUploadFoto" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 480px; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Unggah Foto Dokumentasi</h3>
            <button onclick="document.getElementById('modalUploadFoto').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('komsos.galeri.upload', $album->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label" for="foto">Pilih Berkas Foto * (Maks 8MB)</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="caption">Keterangan Foto / Teks Caption</label>
                <input type="text" name="caption" id="caption" class="form-control" placeholder="Contoh: Perarakan piala dan bahan persembahan">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalUploadFoto').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Unggah Foto</button>
            </div>
        </form>
    </div>
</div>
@endsection

