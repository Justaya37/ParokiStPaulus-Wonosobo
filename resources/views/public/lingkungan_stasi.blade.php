@extends('layouts.public')

@section('title', 'Lingkungan & Stasi - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Wilayah Pastoral</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">14 Lingkungan & 7 Stasi</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Persekutuan paguyuban umat beriman basis di wilayah kota dan stasi-stasi pegunungan Paroki Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <!-- Tab Controls -->
    <div style="display: flex; gap: 0.75rem; margin-bottom: 2.5rem; justify-content: center; flex-wrap: wrap;">
        <button id="btnLingkunganTab" class="btn-paroki btn-primary" onclick="showTab('lingkungan')">
            <i class="fa-solid fa-users"></i> 14 Lingkungan Paroki
        </button>
        <button id="btnStasiTab" class="btn-paroki btn-secondary" onclick="showTab('stasi')">
            <i class="fa-solid fa-church"></i> 7 Stasi Paroki
        </button>
    </div>

    <!-- Section 14 Lingkungan -->
    <div id="tabLingkungan">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 2.5rem auto;">
            <h2 style="font-size: 2rem;">14 Lingkungan Umat Basis</h2>
            <p style="color: var(--color-text-secondary);">Paguyuban keluarga kristiani yang tersebar di wilayah pastoral Wonosobo.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            @foreach($lingkungans as $ling)
                <div class="card-paroki">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge-paroki badge-utama">{{ $ling->nomor_lingkungan }}</span>
                        <span style="font-size: 0.8rem; color: var(--color-text-secondary);"><i class="fa-solid fa-map-pin"></i> {{ $ling->wilayah ?? 'Wonosobo' }}</span>
                    </div>
                    <h3 style="font-size: 1.25rem; margin-bottom: 0.35rem; color: var(--color-primary);">{{ $ling->nama_lingkungan }}</h3>
                    <div style="font-size: 0.85rem; font-weight: 600; color: var(--color-accent); margin-bottom: 0.75rem;">
                        Pelindung: {{ $ling->nama_pelindung }}
                    </div>
                    <div style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.6; border-top: 1px solid var(--color-border); padding-top: 0.75rem;">
                        @if($ling->ketua_lingkungan)
                            <div><strong>Ketua:</strong> {{ $ling->ketua_lingkungan }}</div>
                        @endif
                        @if($ling->kontak)
                            <div><strong>Kontak:</strong> {{ $ling->kontak }}</div>
                        @endif
                        @if($ling->keterangan)
                            <div style="margin-top: 0.25rem;">{{ $ling->keterangan }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Section 7 Stasi -->
    <div id="tabStasi" style="display: none;">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 2.5rem auto;">
            <h2 style="font-size: 2rem;">7 Stasi Wilayah Luar</h2>
            <p style="color: var(--color-text-secondary);">Gereja dan kapel stasi di luar pusat paroki yang tetap bersatu dalam perayaan iman.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
            @foreach($stasis as $st)
                <div class="card-paroki" style="border-top: 4px solid var(--color-secondary);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge-paroki badge-stasi">Stasi Paroki</span>
                        @if($st->jarak_dari_pusat_km)
                            <span style="font-size: 0.8rem; color: var(--color-text-secondary);"><i class="fa-solid fa-route"></i> {{ $st->jarak_dari_pusat_km }} km dari Paroki</span>
                        @endif
                    </div>
                    <h3 style="font-size: 1.35rem; margin-bottom: 0.35rem; color: var(--color-primary);">{{ $st->nama_stasi }}</h3>
                    <div style="font-size: 0.875rem; font-weight: 600; color: var(--color-accent); margin-bottom: 0.75rem;">
                        Pelindung: {{ $st->nama_pelindung }}
                    </div>
                    <div style="font-size: 0.9rem; color: var(--color-text-primary); line-height: 1.7; border-top: 1px solid var(--color-border); padding-top: 0.75rem;">
                        <div><i class="fa-solid fa-location-dot" style="color: var(--color-secondary); margin-right: 0.35rem;"></i> {{ $st->lokasi_desa_kecamatan }}</div>
                        @if($st->kapasitas_umat)
                            <div><i class="fa-solid fa-users" style="color: var(--color-secondary); margin-right: 0.35rem;"></i> Daya Tampung: &plusmn; {{ $st->kapasitas_umat }} Umat</div>
                        @endif
                        @if($st->ketua_stasi)
                            <div><i class="fa-solid fa-user" style="color: var(--color-secondary); margin-right: 0.35rem;"></i> Ketua Stasi: {{ $st->ketua_stasi }}</div>
                        @endif
                    </div>
                    <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px dashed var(--color-border);">
                        <a href="{{ route('public.jadwal', ['stasi_id' => $st->id]) }}" class="btn-paroki btn-secondary btn-sm" style="width: 100%;">
                            <i class="fa-solid fa-calendar-check"></i> Cek Jadwal Misa Stasi Ini
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function showTab(type) {
        const tabL = document.getElementById('tabLingkungan');
        const tabS = document.getElementById('tabStasi');
        const btnL = document.getElementById('btnLingkunganTab');
        const btnS = document.getElementById('btnStasiTab');

        if (type === 'lingkungan') {
            tabL.style.display = 'block';
            tabS.style.display = 'none';
            btnL.className = 'btn-paroki btn-primary';
            btnS.className = 'btn-paroki btn-secondary';
        } else {
            tabL.style.display = 'none';
            tabS.style.display = 'block';
            btnL.className = 'btn-paroki btn-secondary';
            btnS.className = 'btn-paroki btn-primary';
        }
    }
</script>
@endsection

