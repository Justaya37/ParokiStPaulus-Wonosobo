@extends('layouts.public')

@section('title', 'Warta Paroki Mingguan - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Publikasi Resmi</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Arsip Warta Paroki (PDF)</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Unduh lembaran Warta Paroki mingguan resmi berisi intensi misa, pengumuman dewan paroki, dan laporan pastoral.
        </p>
    </div>
</div>

<div class="container section-py">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem; margin-bottom: 2.5rem;">
        @forelse($wartas as $w)
            <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between; border-top: 4px solid var(--color-secondary);">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge-paroki badge-utama">Edisi: {{ $w->edisi }}</span>
                        <span style="font-size: 0.8rem; color: var(--color-text-secondary);">
                            <i class="fa-regular fa-calendar"></i> {{ $w->tanggal_terbit ? $w->tanggal_terbit->isoFormat('D MMM Y') : '' }}
                        </span>
                    </div>

                    <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem; color: var(--color-primary);">{{ $w->judul }}</h3>

                    @if($w->deskripsi)
                        <p style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
                            {{ $w->deskripsi }}
                        </p>
                    @endif

                    <div style="font-size: 0.825rem; color: var(--color-text-secondary); margin-bottom: 1rem;">
                        <i class="fa-solid fa-file-pdf" style="color: var(--color-danger); margin-right: 0.35rem;"></i> Format PDF &bull; {{ $w->formatted_file_size }}
                        &bull; {{ number_format($w->download_count) }} kali diunduh
                    </div>
                </div>

                <div style="border-top: 1px solid var(--color-border); padding-top: 1rem;">
                    <a href="{{ route('public.warta.download', $w->id) }}" class="btn-paroki btn-primary" style="width: 100%;">
                        <i class="fa-solid fa-download"></i> Unduh Berkas PDF
                    </a>
                </div>
            </div>
        @empty
            <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
                <p style="color: var(--color-text-secondary); margin: 0;">Belum ada edisi Warta Paroki yang diunggah ke arsip digital.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $wartas->links() }}
    </div>
</div>
@endsection

