@extends('layouts.public')

@section('title', 'Renungan & Sapaan Gembala - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Pewartaan Sabda</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Sapaan Gembala & Renungan</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Untaian refleksi iman, peneguhan rohani, dan pendalaman Kitab Suci yang dipersembahkan oleh Romo Paroki Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 2.5rem;">
        @forelse($renungans as $rn)
            <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between; border-top: 4px solid var(--color-accent);">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge-paroki badge-published">Sapaan Gembala</span>
                        <span style="font-size: 0.8rem; color: var(--color-text-secondary);">
                            <i class="fa-regular fa-calendar"></i> {{ $rn->tanggal_renungan ? $rn->tanggal_renungan->isoFormat('D MMM Y') : '' }}
                        </span>
                    </div>

                    <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem; line-height: 1.35;">
                        <a href="{{ route('public.renungan.detail', $rn->slug) }}">{{ $rn->judul }}</a>
                    </h3>

                    @if($rn->ayat_bacaan)
                        <div style="font-size: 0.875rem; font-weight: 600; color: var(--color-accent); margin-bottom: 0.75rem;">
                            <i class="fa-solid fa-book-bible"></i> {{ $rn->ayat_bacaan }}
                        </div>
                    @endif

                    <p style="font-size: 0.925rem; color: var(--color-text-primary); line-height: 1.6; margin-bottom: 1.25rem;">
                        {{ Str::limit(strip_tags($rn->isi), 160) }}
                    </p>
                </div>

                <div style="border-top: 1px solid var(--color-border); padding-top: 0.75rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.825rem; color: var(--color-text-secondary);">
                    <span><i class="fa-solid fa-cross"></i> {{ $rn->author->name ?? 'Romo Paroki' }}</span>
                    <a href="{{ route('public.renungan.detail', $rn->slug) }}" class="btn-paroki btn-secondary btn-sm">Baca Renungan</a>
                </div>
            </div>
        @empty
            <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
                <p style="color: var(--color-text-secondary); margin: 0;">Belum ada renungan rohani yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $renungans->links() }}
    </div>
</div>
@endsection

