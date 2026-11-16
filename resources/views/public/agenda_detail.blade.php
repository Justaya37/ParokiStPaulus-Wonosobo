@extends('layouts.public')

@section('title', $agenda->nama_kegiatan . ' - Paroki Santo Paulus Wonosobo')

@section('content')
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3rem 0;">
    <div class="container" style="max-width: 860px;">
        <a href="{{ route('public.agenda') }}" style="color: var(--color-accent); font-size: 0.875rem; text-decoration: none; margin-bottom: 0.75rem; display: inline-block;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Agenda
        </a>
        <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
            <span class="badge-paroki badge-utama" style="background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">{{ $agenda->kategori_kegiatan }}</span>
        </div>
        <h1 style="color: var(--color-white); font-size: 2.25rem; margin-bottom: 0.75rem;">{{ $agenda->nama_kegiatan }}</h1>
        <div style="font-size: 0.95rem; color: #E2D9CF;">
            Penyelenggara: <strong>{{ $agenda->penyelenggara }}</strong>
        </div>
    </div>
</div>

<div class="container section-py" style="max-width: 860px;">
    <!-- Informasi Waktu & Tempat Card -->
    <div class="card-surface" style="margin-bottom: 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
        <div>
            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-secondary);">Tanggal:</div>
            <div style="font-size: 1rem; font-weight: 600; color: var(--color-primary);">
                {{ $agenda->tanggal_mulai ? $agenda->tanggal_mulai->isoFormat('dddd, D MMMM Y') : '' }}
                @if($agenda->tanggal_selesai && $agenda->tanggal_selesai != $agenda->tanggal_mulai)
                    &ndash; {{ $agenda->tanggal_selesai->isoFormat('D MMMM Y') }}
                @endif
            </div>
        </div>
        <div>
            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-secondary);">Waktu:</div>
            <div style="font-size: 1rem; font-weight: 600; color: var(--color-primary);">
                {{ $agenda->waktu_mulai ? date('H:i', strtotime($agenda->waktu_mulai)) . ' WIB' : 'Menyesuaikan' }}
            </div>
        </div>
        <div>
            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-secondary);">Lokasi:</div>
            <div style="font-size: 1rem; font-weight: 600; color: var(--color-primary);">
                {{ $agenda->lokasi }}
            </div>
        </div>
    </div>

    <!-- Deskripsi Lengkap -->
    <div class="card-paroki" style="padding: 2rem; line-height: 1.8; font-size: 1.05rem;">
        {!! nl2br(e($agenda->deskripsi)) !!}
    </div>

    @if($agenda->kontak_person)
        <div class="card-surface" style="margin-top: 1.5rem; font-size: 0.9rem;">
            <i class="fa-solid fa-phone" style="color: var(--color-secondary); margin-right: 0.5rem;"></i> Kontak Informasi / Narahubung: <strong>{{ $agenda->kontak_person }}</strong>
        </div>
    @endif
</div>
@endsection

