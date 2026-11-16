@extends('layouts.public')

@section('title', 'Profil & Sejarah - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Page Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Identitas & Sejarah</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Profil & Sejarah Paroki</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 650px;">
            Mengenal perjalanan iman, visi misi penggembalaan, dan tonggak peristiwa berdirinya Paroki Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <!-- Identitas Paroki -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; margin-bottom: 4rem;">
        <div>
            <h2 style="font-size: 1.85rem; margin-bottom: 1rem;">Visi & Misi Pastoral</h2>
            <div class="card-paroki" style="margin-bottom: 1.5rem; border-left: 4px solid var(--color-primary);">
                <h3 style="font-size: 1.15rem; color: var(--color-primary); margin-bottom: 0.5rem;">Visi</h3>
                <p style="font-size: 0.95rem; line-height: 1.7; color: var(--color-text-primary); margin: 0;">
                    {{ $profil->visi ?? 'Terwujudnya persekutuan umat beriman yang berakar mendalam dalam Kristus, berjiwa inklusif, merawat kebudayaan lokal, dan berbela rasa bagi sesama di bumi Wonosobo.' }}
                </p>
            </div>
            <div class="card-paroki" style="border-left: 4px solid var(--color-secondary);">
                <h3 style="font-size: 1.15rem; color: var(--color-secondary); margin-bottom: 0.5rem;">Misi</h3>
                <div style="font-size: 0.95rem; line-height: 1.7; color: var(--color-text-primary); white-space: pre-line;">
                    {{ $profil->misi ?? "1. Menumbuhkembangkan kehidupan doa dan sakramental yang berakar pada Sabda Allah.\n2. Mengembangkan dialog kehidupan dan inkulturasi budaya Jawa dalam liturgi.\n3. Mewujudkan persaudaraan sejati di 14 lingkungan dan 7 stasi." }}
                </div>
            </div>
        </div>

        <div>
            <h2 style="font-size: 1.85rem; margin-bottom: 1rem;">Identitas Gereja</h2>
            <div class="card-surface">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.925rem;">
                    <tr style="border-bottom: 1px solid var(--color-border);">
                        <td style="padding: 0.75rem 0; font-weight: 600; width: 140px; color: var(--color-secondary);">Nama Resmi</td>
                        <td style="padding: 0.75rem 0; font-weight: 700; color: var(--color-primary);">{{ $profil->nama_paroki }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-border);">
                        <td style="padding: 0.75rem 0; font-weight: 600; color: var(--color-secondary);">Pelindung</td>
                        <td style="padding: 0.75rem 0;">{{ $profil->pelindung }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-border);">
                        <td style="padding: 0.75rem 0; font-weight: 600; color: var(--color-secondary);">Pesta Nama</td>
                        <td style="padding: 0.75rem 0;">{{ $profil->pesta_nama }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-border);">
                        <td style="padding: 0.75rem 0; font-weight: 600; color: var(--color-secondary);">Keuskupan</td>
                        <td style="padding: 0.75rem 0;">{{ $profil->keuskupan }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-border);">
                        <td style="padding: 0.75rem 0; font-weight: 600; color: var(--color-secondary);">Alamat</td>
                        <td style="padding: 0.75rem 0;">{{ $profil->alamat }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.75rem 0; font-weight: 600; color: var(--color-secondary);">Kontak</td>
                        <td style="padding: 0.75rem 0;">{{ $profil->telepon }} &bull; {{ $profil->email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Linimasa Sejarah Paroki -->
    <div style="margin-bottom: 4rem;">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 3rem auto;">
            <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem;">Jejak Karya Roh Kudus</span>
            <h2 style="font-size: 2.25rem;">Linimasa Sejarah Paroki</h2>
            <p style="color: var(--color-text-secondary); font-size: 1rem;">
                Tonggak sejarah dan babak-babak penting dalam peziarahan iman umat Katolik di Wonosobo.
            </p>
        </div>

        <div style="position: relative; max-width: 860px; margin: 0 auto; padding-left: 2rem; border-left: 3px solid var(--color-secondary);">
            @forelse($sejarah as $sj)
                <div style="position: relative; margin-bottom: 2.5rem;">
                    <!-- Circle node -->
                    <div style="position: absolute; left: -2.75rem; top: 0; width: 22px; height: 22px; border-radius: 50%; background-color: var(--color-accent); border: 4px solid var(--color-white); box-shadow: var(--shadow-sm);"></div>
                    
                    <div class="card-paroki">
                        <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-accent); margin-bottom: 0.35rem;">
                            {{ $sj->tahun }}
                        </div>
                        <h3 style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--color-primary);">{{ $sj->judul_peristiwa }}</h3>
                        <p style="font-size: 0.95rem; line-height: 1.7; color: var(--color-text-primary); margin: 0;">
                            {{ $sj->deskripsi }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="card-surface" style="padding: 2rem; text-align: center;">
                    <p style="color: var(--color-text-secondary); margin: 0;">Data linimasa sejarah paroki sedang diverifikasi oleh tim sejarah paroki.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Organisasi Kategorial -->
    <div>
        <div style="text-align: center; max-width: 650px; margin: 0 auto 2.5rem auto;">
            <span class="badge-paroki badge-stasi" style="margin-bottom: 0.5rem;">Kelompok Kategorial</span>
            <h2 style="font-size: 2.25rem;">Organisasi Kategorial Resmi</h2>
            <p style="color: var(--color-text-secondary); font-size: 1rem;">
                Wadah persaudaraan, pelayanan, dan kerasulan umat beriman di Paroki Santo Paulus Wonosobo.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            @foreach($kategorials as $kat)
                <div class="card-paroki">
                    <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem;">{{ $kat->kode_organisasi }}</span>
                    <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">{{ $kat->nama_organisasi }}</h3>
                    <p style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1rem;">
                        {{ $kat->deskripsi }}
                    </p>
                    @if($kat->visi_misi)
                        <div style="font-size: 0.85rem; color: var(--color-text-primary); font-style: italic; border-top: 1px solid var(--color-border); padding-top: 0.75rem;">
                            "{{ $kat->visi_misi }}"
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

