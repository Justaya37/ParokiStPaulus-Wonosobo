@extends('layouts.public')

@section('title', 'Jadwal Perayaan Ekaristi - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Liturgi Paroki</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Jadwal Perayaan Ekaristi</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Jadwal Misa Harian, Misa Mingguan, dan Hari Raya Khusus di Gereja Utama Santo Paulus Wonosobo dan 7 Stasi Wilayah.
        </p>
    </div>
</div>

<div class="container section-py">
    <!-- Filter Navigation Bar -->
    <div class="card-surface" style="margin-bottom: 2.5rem; padding: 1.25rem;">
        <form action="{{ route('public.jadwal') }}" method="GET" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <div style="font-weight: 600; color: var(--color-primary); font-size: 0.95rem;">
                <i class="fa-solid fa-filter"></i> Saring Berdasarkan Lokasi:
            </div>
            <div style="flex-grow: 1; min-width: 200px;">
                <select name="stasi_id" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Seluruh Lokasi (Gereja Utama & 7 Stasi) --</option>
                    <option value="utama" {{ request('stasi_id') === 'utama' ? 'selected' : '' }}>Gereja Utama Santo Paulus Wonosobo</option>
                    @foreach($stasis as $st)
                        <option value="{{ $st->id }}" {{ request('stasi_id') == $st->id ? 'selected' : '' }}>
                            {{ $st->nama_stasi }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(request('stasi_id'))
                <a href="{{ route('public.jadwal') }}" class="btn-paroki btn-secondary btn-sm">Reset Filter</a>
            @endif
        </form>
    </div>

    <!-- Jadwal Cards / Table -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.75rem;">
        @forelse($jadwals as $j)
            <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between; border-left: 5px solid {{ $j->stasi_id ? 'var(--color-secondary)' : 'var(--color-primary)' }};">
                <div>
                    <!-- Header Kartu -->
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem; gap: 0.5rem;">
                        <span class="badge-paroki {{ $j->stasi_id ? 'badge-stasi' : 'badge-utama' }}">
                            {{ $j->stasi ? $j->stasi->nama_stasi : 'Gereja Utama Wonosobo' }}
                        </span>
                        <span style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--color-accent); border: 1px solid var(--color-border); padding: 0.2rem 0.5rem; border-radius: var(--radius-sm);">
                            {{ ucfirst(str_replace('_', ' ', $j->tipe_perayaan)) }}
                        </span>
                    </div>

                    <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem; color: var(--color-primary);">{{ $j->nama_perayaan }}</h3>

                    <!-- Waktu dan Hari -->
                    <div style="background-color: var(--color-bg); padding: 0.75rem; border-radius: var(--radius-md); border: 1px solid var(--color-border); margin-bottom: 1rem;">
                        <div style="font-size: 1.2rem; font-weight: 700; color: var(--color-secondary);">
                            <i class="fa-regular fa-clock" style="color: var(--color-accent); margin-right: 0.35rem;"></i>
                            {{ date('H:i', strtotime($j->waktu_mulai)) }} WIB
                            @if($j->waktu_selesai)
                                &ndash; {{ date('H:i', strtotime($j->waktu_selesai)) }} WIB
                            @endif
                        </div>
                        <div style="font-size: 0.9rem; font-weight: 600; color: var(--color-text-primary); margin-top: 0.25rem;">
                            <i class="fa-regular fa-calendar" style="color: var(--color-accent); margin-right: 0.35rem;"></i>
                            {{ $j->hari ?? ($j->tanggal ? $j->tanggal->isoFormat('dddd, D MMMM Y') : 'Jadwal Rutin') }}
                        </div>
                    </div>

                    <!-- Keterangan & Bahasa -->
                    <div style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1rem;">
                        <div><strong>Pengantar:</strong> {{ $j->bahasa }}</div>
                        @if($j->lokasi_keterangan)
                            <div><strong>Lokasi Detail:</strong> {{ $j->lokasi_keterangan }}</div>
                        @endif
                        @if($j->keterangan)
                            <div style="margin-top: 0.25rem; font-style: italic;">"{{ $j->keterangan }}"</div>
                        @endif
                    </div>

                    <!-- Petugas Liturgi Bertugas -->
                    @if($j->petugasLiturgis->count() > 0)
                        <div style="border-top: 1px solid var(--color-border); padding-top: 0.75rem;">
                            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-accent); letter-spacing: 0.05em; margin-bottom: 0.35rem;">
                                Petugas Liturgi:
                            </div>
                            <ul style="list-style: none; font-size: 0.825rem; line-height: 1.6;">
                                @foreach($j->petugasLiturgis as $pet)
                                    <li style="display: flex; justify-content: space-between; gap: 0.5rem;">
                                        <span style="font-weight: 600; color: var(--color-primary);">{{ $pet->peran->nama_peran ?? 'Petugas' }}:</span>
                                        <span style="color: var(--color-text-secondary); text-align: right;">
                                            {{ $pet->nama_petugas }}
                                            @if($pet->lingkungan)
                                                ({{ $pet->lingkungan->nama_lingkungan }})
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="card-surface" style="grid-column: 1/-1; padding: 3rem; text-align: center;">
                <i class="fa-regular fa-calendar-xmark" style="font-size: 3rem; color: var(--color-secondary); margin-bottom: 1rem; opacity: 0.5;"></i>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Tidak Ada Jadwal Misa Ditemukan</h3>
                <p style="color: var(--color-text-secondary); margin: 0;">Tidak ada perayaan Ekaristi aktif untuk pilihan saringan lokasi ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

