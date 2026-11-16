@extends('layouts.public')

@section('title', 'Berita Paroki - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Media Komsos & OMK</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Berita & Kabar Paroki</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Liputan kegiatan pastoral, pewartaan iman, dan informasi terkini dari seluruh sudut Paroki Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 2.5rem;">
        @forelse($beritas as $b)
            <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge-paroki badge-utama">{{ $b->kategori->nama_kategori ?? 'Warta Paroki' }}</span>
                        <span style="font-size: 0.8rem; color: var(--color-text-secondary);">
                            <i class="fa-regular fa-calendar"></i> {{ $b->published_at ? $b->published_at->isoFormat('D MMM Y') : '' }}
                        </span>
                    </div>

                    <h3 style="font-size: 1.35rem; margin-bottom: 0.75rem; line-height: 1.35;">
                        <a href="{{ route('public.berita.detail', $b->slug) }}">{{ $b->judul }}</a>
                    </h3>

                    <p style="font-size: 0.925rem; color: var(--color-text-primary); line-height: 1.6; margin-bottom: 1.25rem;">
                        {{ $b->ringkasan ?? Str::limit(strip_tags($b->isi), 140) }}
                    </p>
                </div>

                <div style="border-top: 1px solid var(--color-border); padding-top: 0.75rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.825rem; color: var(--color-text-secondary);">
                    <span><i class="fa-solid fa-pen-nib"></i> {{ $b->author->name ?? 'Tim Komsos' }}</span>
                    <a href="{{ route('public.berita.detail', $b->slug) }}" class="btn-paroki btn-secondary btn-sm">Baca Selengkapnya</a>
                </div>
            </div>
        @empty
            <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
                <p style="color: var(--color-text-secondary); margin: 0;">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $beritas->links() }}
    </div>
</div>
@endsection

