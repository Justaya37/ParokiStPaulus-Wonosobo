@extends('layouts.public')

@section('title', $berita->judul . ' - Paroki Santo Paulus Wonosobo')

@section('content')
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3rem 0;">
    <div class="container" style="max-width: 860px;">
        <a href="{{ route('public.berita') }}" style="color: var(--color-accent); font-size: 0.875rem; text-decoration: none; margin-bottom: 0.75rem; display: inline-block;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog Berita
        </a>
        <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
            <span class="badge-paroki badge-utama" style="background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">{{ $berita->kategori->nama_kategori ?? 'Warta Paroki' }}</span>
        </div>
        <h1 style="color: var(--color-white); font-size: 2.25rem; margin-bottom: 1rem; line-height: 1.25;">{{ $berita->judul }}</h1>
        <div style="font-size: 0.875rem; color: #E2D9CF; display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <span><i class="fa-solid fa-user" style="color: var(--color-accent);"></i> {{ $berita->author->name ?? 'Tim Komsos' }}</span>
            <span><i class="fa-regular fa-calendar" style="color: var(--color-accent);"></i> {{ $berita->published_at ? $berita->published_at->isoFormat('dddd, D MMMM Y') : '' }}</span>
            <span><i class="fa-regular fa-eye" style="color: var(--color-accent);"></i> {{ number_format($berita->view_count) }} kali dibaca</span>
        </div>
    </div>
</div>

<div class="container section-py" style="max-width: 860px;">
    <!-- Lead Summary -->
    @if($berita->ringkasan)
        <div class="card-surface" style="font-size: 1.15rem; font-weight: 500; line-height: 1.7; margin-bottom: 2rem; border-left: 4px solid var(--color-secondary);">
            {{ $berita->ringkasan }}
        </div>
    @endif

    <!-- Body Article -->
    <article class="card-paroki" style="padding: 2.5rem; font-size: 1.05rem; line-height: 1.8; color: var(--color-text-primary); margin-bottom: 3rem;">
        {!! nl2br(e($berita->isi)) !!}
    </article>

    <!-- Berita Terkait -->
    @if($beritaTerkait->count() > 0)
        <div>
            <h3 style="font-size: 1.35rem; margin-bottom: 1.25rem; color: var(--color-primary);">Berita Lainnya</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem;">
                @foreach($beritaTerkait as $bt)
                    <div class="card-surface" style="padding: 1rem;">
                        <span style="font-size: 0.75rem; color: var(--color-text-secondary); font-weight: 600;">
                            {{ $bt->published_at ? $bt->published_at->isoFormat('D MMM Y') : '' }}
                        </span>
                        <h4 style="font-size: 1rem; margin-top: 0.25rem; line-height: 1.3;">
                            <a href="{{ route('public.berita.detail', $bt->slug) }}">{{ $bt->judul }}</a>
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

