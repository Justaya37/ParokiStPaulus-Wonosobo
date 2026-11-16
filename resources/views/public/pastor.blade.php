@extends('layouts.public')

@section('title', 'Daftar Pastor Paroki - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Pelayan Altar</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Daftar Pastor Paroki</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Para gembala yang melayani dan pernah berkarya menggembalakan kawanan domba Kristus di Paroki Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
        @forelse($pastors as $p)
            <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; gap: 1.25rem; align-items: flex-start; margin-bottom: 1.25rem;">
                        <div style="width: 72px; height: 72px; border-radius: 50%; background-color: var(--color-surface); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--color-secondary); border: 2px solid var(--color-accent); flex-shrink: 0;">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <span class="badge-paroki {{ $p->status_pelayanan === 'aktif' ? 'badge-published' : 'badge-utama' }}" style="margin-bottom: 0.35rem;">
                                {{ ucfirst($p->status_pelayanan) }}
                            </span>
                            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">{{ $p->nama_lengkap }}</h3>
                            <div style="font-size: 0.85rem; color: var(--color-text-secondary); margin-top: 0.2rem;">
                                {{ $p->gelar_sebutan ?? 'Romo' }}
                            </div>
                        </div>
                    </div>

                    @if($p->keterangan)
                        <p style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
                            {{ $p->keterangan }}
                        </p>
                    @endif

                    <!-- Riwayat Periode Penugasan -->
                    <div style="border-top: 1px solid var(--color-border); padding-top: 1rem;">
                        <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--color-secondary); letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                            Riwayat Periode Pelayanan:
                        </div>
                        <ul style="list-style: none; font-size: 0.875rem; line-height: 1.8;">
                            @forelse($p->pelayanans as $pel)
                                <li style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed var(--color-border); padding: 0.25rem 0;">
                                    <span style="font-weight: 600; color: var(--color-primary);">{{ $pel->jabatan }}</span>
                                    <span style="color: var(--color-text-secondary);">
                                        {{ $pel->tahun_mulai }} &ndash; {{ $pel->tahun_selesai ?? 'Sekarang' }}
                                    </span>
                                </li>
                            @empty
                                <li style="color: var(--color-text-secondary); font-style: italic;">Riwayat masa bakti sedang diverifikasi sekretariat.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="card-surface" style="grid-column: 1/-1; padding: 2.5rem; text-align: center;">
                <p style="color: var(--color-text-secondary); margin: 0;">Data pastor paroki sedang disiapkan oleh sekretariat.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

