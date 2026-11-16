@extends('layouts.public')

@section('title', $album->judul . ' - Galeri Paroki Santo Paulus')

@section('content')
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3rem 0;">
    <div class="container">
        <a href="{{ route('public.galeri') }}" style="color: var(--color-accent); font-size: 0.875rem; text-decoration: none; margin-bottom: 0.75rem; display: inline-block;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Album
        </a>
        <h1 style="color: var(--color-white); font-size: 2.25rem; margin-bottom: 0.5rem;">{{ $album->judul }}</h1>
        <div style="font-size: 0.95rem; color: #E2D9CF;">
            Tanggal Kegiatan: <strong>{{ $album->tanggal_kegiatan ? $album->tanggal_kegiatan->isoFormat('D MMMM Y') : 'Dokumentasi Paroki' }}</strong>
            &bull; Total {{ $album->fotos->count() }} Foto
        </div>
    </div>
</div>

<div class="container section-py">
    @if($album->deskripsi)
        <div class="card-surface" style="margin-bottom: 2.5rem; font-size: 1rem; line-height: 1.7; max-width: 900px; margin-left: auto; margin-right: auto;">
            {{ $album->deskripsi }}
        </div>
    @endif

    {{-- KONDISI 1: JIKA HANYA 1 FOTO (SEPERTI ALBUM TES UNGGAH), TAMPILKAN UTUH & PROPORSIONAL --}}
    @if($album->fotos->count() === 1)
        @php $singleFoto = $album->fotos->first(); @endphp
        <div style="max-width: 860px; margin: 0 auto;">
            <div class="card-paroki" style="padding: 1rem; text-align: center; border-radius: var(--radius-lg); overflow: hidden;">
                @if(Storage::disk('public')->exists($singleFoto->file_path))
                    <div style="background-color: var(--color-surface); border-radius: var(--radius-md); overflow: hidden; display: flex; align-items: center; justify-content: center; cursor: pointer;" onclick="openLightbox('{{ asset('storage/' . $singleFoto->file_path) }}', '{{ addslashes($singleFoto->caption ?? $album->judul) }}')">
                        <img src="{{ asset('storage/' . $singleFoto->file_path) }}" 
                             alt="{{ $singleFoto->caption ?? $album->judul }}" 
                             style="width: 100%; max-width: 100%; height: auto; max-height: 75vh; object-fit: contain; display: block; margin: 0 auto; border-radius: var(--radius-md);">
                    </div>
                @else
                    <div style="height: 320px; background-color: var(--color-surface); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-md);">
                        <div style="text-align: center; color: var(--color-text-secondary);">
                            <i class="fa-solid fa-image" style="font-size: 3rem; opacity: 0.4;"></i>
                            <div style="font-size: 0.85rem; margin-top: 0.5rem;">Foto Dokumentasi</div>
                        </div>
                    </div>
                @endif

                @if($singleFoto->caption)
                    <div style="margin-top: 1rem; padding: 0.5rem 1rem; background-color: var(--color-surface); border-radius: var(--radius-md); display: inline-block;">
                        <p style="font-size: 0.95rem; color: var(--color-text-primary); margin: 0; line-height: 1.5;">
                            {{ $singleFoto->caption }}
                        </p>
                    </div>
                @endif
                <div style="margin-top: 0.75rem; font-size: 0.8rem; color: var(--color-text-secondary);">
                    <i class="fa-solid fa-magnifying-glass-plus" style="margin-right: 0.25rem;"></i> Klik foto untuk memperbesar tampilan penuh
                </div>
            </div>
        </div>

    {{-- KONDISI 2: JIKA LEBIH DARI 1 FOTO, TAMPILKAN GRID PROPORSIONAL ASPECT 4:3 DENGAN LIGHTBOX --}}
    @elseif($album->fotos->count() > 1)
        <div class="galeri-grid-3">
            @foreach($album->fotos as $f)
                <div class="card-paroki" style="padding: 0.75rem; border-radius: var(--radius-lg); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="aspect-4-3" style="border-radius: var(--radius-md); cursor: pointer;" onclick="openLightbox('{{ asset('storage/' . $f->file_path) }}', '{{ addslashes($f->caption ?? $album->judul) }}')">
                            @if(Storage::disk('public')->exists($f->file_path))
                                <img src="{{ asset('storage/' . $f->file_path) }}" alt="{{ $f->caption ?? 'Foto Galeri' }}" class="galeri-img-cover">
                            @else
                                <div class="galeri-placeholder">
                                    <i class="fa-solid fa-image" style="font-size: 2.5rem; opacity: 0.4;"></i>
                                    <span style="font-size: 0.75rem; margin-top: 0.25rem;">Foto Dokumentasi</span>
                                </div>
                            @endif
                        </div>
                        @if($f->caption)
                            <p style="font-size: 0.875rem; color: var(--color-text-primary); margin-top: 0.75rem; line-height: 1.5;">
                                {{ $f->caption }}
                            </p>
                        @endif
                    </div>
                    <div style="margin-top: 0.75rem; text-align: right;">
                        <button type="button" class="btn-paroki btn-secondary btn-sm" style="font-size: 0.75rem; padding: 0.3rem 0.6rem;" onclick="openLightbox('{{ asset('storage/' . $f->file_path) }}', '{{ addslashes($f->caption ?? $album->judul) }}')">
                            <i class="fa-solid fa-expand"></i> Perbesar
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card-surface" style="padding: 3rem; text-align: center; max-width: 600px; margin: 0 auto;">
            <i class="fa-solid fa-images" style="font-size: 3rem; color: var(--color-secondary); opacity: 0.4; margin-bottom: 1rem;"></i>
            <p style="color: var(--color-text-secondary); margin: 0;">Foto-foto untuk album ini sedang diunggah oleh Tim Komsos.</p>
        </div>
    @endif
</div>

<!-- Lightbox Modal -->
<div id="galeriLightbox" class="lightbox-modal" onclick="closeLightbox(event)">
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <button type="button" class="lightbox-close" onclick="closeLightbox()" aria-label="Tutup Foto">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <img id="lightboxImage" src="" alt="Tampilan Penuh Foto" class="lightbox-img">
        <div id="lightboxCaption" class="lightbox-caption"></div>
    </div>
</div>

@push('scripts')
<script>
    function openLightbox(src, caption) {
        const modal = document.getElementById('galeriLightbox');
        const img = document.getElementById('lightboxImage');
        const cap = document.getElementById('lightboxCaption');
        
        img.src = src;
        cap.textContent = caption || '';
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        if (!e || e.target === document.getElementById('galeriLightbox') || e.target.closest('.lightbox-close')) {
            const modal = document.getElementById('galeriLightbox');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>
@endpush
@endsection

