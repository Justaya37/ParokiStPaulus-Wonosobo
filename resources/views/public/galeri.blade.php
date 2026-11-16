@extends('layouts.public')

@section('title', 'Galeri Kegiatan - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Dokumentasi Umat</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Galeri Foto Dokumentasi</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Rekaman visual suasana perayaan liturgis, aksi sosial, dan kebersamaan persekutuan umat di Paroki Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <div class="galeri-grid-3" style="margin-bottom: 2.5rem;">
        @forelse($albums as $alb)
            @php
                $coverUrl = $alb->cover_url;
            @endphp
            <a href="{{ route('public.galeri.detail', $alb->slug) }}" class="card-paroki" style="text-decoration: none; padding: 0; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; border-radius: var(--radius-lg);">
                <div>
                    <div class="aspect-4-3">
                        @if($coverUrl)
                            <img src="{{ $coverUrl }}" alt="{{ $alb->judul }}" class="galeri-img-cover">
                        @else
                            <div class="galeri-placeholder">
                                <i class="fa-solid fa-camera-retro" style="font-size: 3rem; opacity: 0.45; margin-bottom: 0.5rem;"></i>
                                <span style="font-size: 0.8rem; font-weight: 600; opacity: 0.7;">Dokumentasi Paroki</span>
                            </div>
                        @endif
                    </div>
                    <div style="padding: 1.25rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <span style="font-size: 0.8rem; color: var(--color-text-secondary); font-weight: 600;">
                                <i class="fa-regular fa-calendar"></i> {{ $alb->tanggal_kegiatan ? $alb->tanggal_kegiatan->isoFormat('D MMM Y') : 'Dokumentasi' }}
                            </span>
                            <span class="badge-paroki badge-stasi">{{ $alb->fotos->count() }} Foto</span>
                        </div>
                        <h3 style="font-size: 1.25rem; color: var(--color-primary); margin-bottom: 0.5rem; line-height: 1.35;">{{ $alb->judul }}</h3>
                        @if($alb->deskripsi)
                            <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.6; margin: 0;">
                                {{ Str::limit($alb->deskripsi, 90) }}
                            </p>
                        @endif
                    </div>
                </div>
                <div style="padding: 0 1.25rem 1.25rem 1.25rem; text-align: right;">
                    <span style="font-size: 0.85rem; font-weight: 600; color: var(--color-secondary);">Buka Album <i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </a>
        @empty
            <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
                <p style="color: var(--color-text-secondary); margin: 0;">Belum ada album galeri foto yang diterbitkan.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $albums->links() }}
    </div>
</div>
@endsection

