@extends('layouts.public')

@section('title', $renungan->judul . ' - Renungan Gembala Paroki Santo Paulus')

@section('content')
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3rem 0;">
    <div class="container" style="max-width: 820px;">
        <a href="{{ route('public.renungan') }}" style="color: var(--color-accent); font-size: 0.875rem; text-decoration: none; margin-bottom: 0.75rem; display: inline-block;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Kumpulan Renungan
        </a>
        <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
            <span class="badge-paroki badge-utama" style="background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Sapaan Gembala</span>
        </div>
        <h1 style="color: var(--color-white); font-size: 2.35rem; margin-bottom: 0.75rem; line-height: 1.25;">{{ $renungan->judul }}</h1>
        
        @if($renungan->ayat_bacaan)
            <div style="font-size: 1.1rem; color: var(--color-accent); font-weight: 600; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-book-bible"></i> Bacaan: {{ $renungan->ayat_bacaan }}
            </div>
        @endif

        <div style="font-size: 0.875rem; color: #E2D9CF; display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <span><i class="fa-solid fa-user-tie" style="color: var(--color-accent);"></i> {{ $renungan->author->name ?? 'Romo Paroki' }}</span>
            <span><i class="fa-regular fa-calendar" style="color: var(--color-accent);"></i> {{ $renungan->tanggal_renungan ? $renungan->tanggal_renungan->isoFormat('dddd, D MMMM Y') : '' }}</span>
            <span><i class="fa-regular fa-eye" style="color: var(--color-accent);"></i> {{ number_format($renungan->view_count) }} kali dibaca</span>
        </div>
    </div>
</div>

<div class="container section-py" style="max-width: 820px;">
    <!-- Naskah Renungan Editorial -->
    <article class="card-paroki" style="padding: 2.75rem; font-size: 1.1rem; line-height: 1.85; color: var(--color-text-primary); margin-bottom: 3rem; background-color: var(--color-white);">
        {!! nl2br(e($renungan->isi)) !!}
        
        <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--color-border); font-style: italic; color: var(--color-secondary); font-size: 0.95rem;">
            Berkah Dalem.<br>
            <strong>{{ $renungan->author->name ?? 'Romo Paroki Santo Paulus Wonosobo' }}</strong>
        </div>
    </article>
</div>
@endsection

