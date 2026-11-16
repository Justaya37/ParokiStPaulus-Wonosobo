@extends('layouts.public')

@section('title', 'Informasi Pelayanan Sakramen - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Liturgi & Katekese</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Informasi & Panduan 7 Sakramen</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 700px;">
            Pedoman katekese, persyaratan berkas fisik, dan alur prosedur pelayanan sakramental di Paroki Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <!-- Notice Card -->
    <div class="card-surface" style="margin-bottom: 3rem; border-left: 4px solid var(--color-accent); padding: 1.5rem;">
        <div style="display: flex; gap: 1rem; align-items: flex-start;">
            <i class="fa-solid fa-circle-info" style="font-size: 1.5rem; color: var(--color-accent); margin-top: 0.2rem;"></i>
            <div>
                <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem; color: var(--color-primary);">Pelayanan Pastoral Tatap Muka</h4>
                <p style="font-size: 0.925rem; color: var(--color-text-secondary); margin: 0; line-height: 1.6;">
                    Demi menjamin ketertiban kanonik hukum Gereja Katolik dan perlindungan data pribadi umat, seluruh pendaftaran, wawancara kanonik, dan verifikasi berkas sakramen dilakukan secara langsung <strong>tatap muka</strong> di Kantor Sekretariat Paroki Santo Paulus Wonosobo atau melalui Ketua Lingkungan setempat.
                </p>
            </div>
        </div>
    </div>

    <!-- 7 Sakramen Cards -->
    <div style="display: flex; flex-direction: column; gap: 2.5rem;">
        @foreach($sakramens as $sk)
            <div class="card-paroki" style="border-top: 4px solid var(--color-primary); padding: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge-paroki badge-utama">Sakramen Gereja #{{ $sk->urutan }}</span>
                    @if($sk->kontak_layanan)
                        <span style="font-size: 0.8rem; color: var(--color-text-secondary);">
                            <i class="fa-solid fa-phone"></i> {{ $sk->kontak_layanan }}
                        </span>
                    @endif
                </div>

                <h2 style="font-size: 1.85rem; margin-bottom: 0.75rem; color: var(--color-primary);">{{ $sk->nama_sakramen }}</h2>

                <!-- Pengantar Teologis -->
                <div style="font-size: 1rem; line-height: 1.7; color: var(--color-text-primary); margin-bottom: 1.5rem; font-style: italic; background-color: var(--color-bg); padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--color-border);">
                    "{{ $sk->deskripsi_teologis }}"
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
                    <!-- Persyaratan Fisik -->
                    <div style="background-color: var(--color-white); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--radius-md);">
                        <h4 style="font-size: 1.05rem; color: var(--color-secondary); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-clipboard-check" style="color: var(--color-accent);"></i> Persyaratan Berkas Fisik:
                        </h4>
                        <div style="font-size: 0.9rem; line-height: 1.7; color: var(--color-text-primary); white-space: pre-line;">
                            {{ $sk->persyaratan }}
                        </div>
                    </div>

                    <!-- Prosedur Pelayanan -->
                    <div style="background-color: var(--color-white); border: 1px solid var(--color-border); padding: 1.25rem; border-radius: var(--radius-md);">
                        <h4 style="font-size: 1.05rem; color: var(--color-secondary); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-list-ol" style="color: var(--color-accent);"></i> Prosedur & Alur Pelayanan:
                        </h4>
                        <div style="font-size: 0.9rem; line-height: 1.7; color: var(--color-text-primary); white-space: pre-line;">
                            {{ $sk->prosedur_pelayanan }}
                        </div>
                    </div>
                </div>

                @if($sk->jadwal_pelayanan_rutin)
                    <div style="margin-top: 1.25rem; padding-top: 0.75rem; border-top: 1px dashed var(--color-border); font-size: 0.875rem; color: var(--color-text-secondary);">
                        <i class="fa-regular fa-clock" style="color: var(--color-accent); margin-right: 0.35rem;"></i>
                        <strong>Jadwal Pelaksanaan:</strong> {{ $sk->jadwal_pelayanan_rutin }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

