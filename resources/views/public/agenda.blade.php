@extends('layouts.public')

@section('title', 'Agenda Kegiatan - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Kalender Pastoral</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Agenda Kegiatan Paroki</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Jadwal kegiatan perayaan liturgis, pembinaan rohani, pertemuan dewan pastoral, dan bakti umat.
        </p>
    </div>
</div>

<div class="container section-py">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem; margin-bottom: 2.5rem;">
        @forelse($agendas as $ag)
            <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge-paroki badge-utama">{{ $ag->kategori_kegiatan }}</span>
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--color-accent);">
                            <i class="fa-regular fa-calendar"></i> {{ $ag->tanggal_mulai ? $ag->tanggal_mulai->isoFormat('D MMM Y') : '' }}
                        </span>
                    </div>

                    <h3 style="font-size: 1.3rem; margin-bottom: 0.5rem; color: var(--color-primary);">
                        <a href="{{ route('public.agenda.detail', $ag->slug) }}">{{ $ag->nama_kegiatan }}</a>
                    </h3>

                    <div style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1rem;">
                        <div><i class="fa-solid fa-location-dot" style="color: var(--color-secondary); width: 18px;"></i> {{ $ag->lokasi }}</div>
                        @if($ag->waktu_mulai)
                            <div><i class="fa-regular fa-clock" style="color: var(--color-secondary); width: 18px;"></i> {{ date('H:i', strtotime($ag->waktu_mulai)) }} WIB</div>
                        @endif
                        <div><i class="fa-solid fa-users" style="color: var(--color-secondary); width: 18px;"></i> {{ $ag->penyelenggara }}</div>
                    </div>

                    <p style="font-size: 0.9rem; color: var(--color-text-primary); line-height: 1.6; margin: 0;">
                        {{ Str::limit(strip_tags($ag->deskripsi), 140) }}
                    </p>
                </div>

                <div style="border-top: 1px solid var(--color-border); padding-top: 0.75rem; margin-top: 1rem; text-align: right;">
                    <a href="{{ route('public.agenda.detail', $ag->slug) }}" class="btn-paroki btn-secondary btn-sm">Detail Kegiatan <i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
        @empty
            <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
                <p style="color: var(--color-text-secondary); margin: 0;">Belum ada agenda kegiatan yang terdaftar untuk periode mendatang.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $agendas->links() }}
    </div>
</div>
@endsection

