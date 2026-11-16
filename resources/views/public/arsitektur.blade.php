@extends('layouts.public')

@section('title', 'Filosofi Arsitektur & 20 Simbol - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Header -->
<div style="background-color: var(--color-primary); color: var(--color-white); padding: 3.5rem 0;">
    <div class="container">
        <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem; background: rgba(255, 255, 255, 0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25);">Arsitektur Sakral</span>
        <h1 style="color: var(--color-white); font-size: 2.5rem; margin-bottom: 0.5rem;">Filosofi Arsitektur & 20 Simbol Gereja</h1>
        <p style="color: #E2D9CF; font-size: 1.1rem; max-width: 700px;">
            Menyelami keindahan inkulturasi <em>Joglo Pangrawit Ceblokan</em> dan spiritualitas <em>Goa Garba (Garbha Griha)</em> dalam tata ruang peribadatan Gereja Santo Paulus Wonosobo.
        </p>
    </div>
</div>

<div class="container section-py">
    <!-- Penjelasan Konsep Filosofis -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; margin-bottom: 4rem; align-items: center;">
        <div>
            <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem;">Konsep Ruang Sakral</span>
            <h2 style="font-size: 2.25rem; margin-bottom: 1rem;">{{ $filosofi->konsep_utama ?? 'Goa Garba / Garbha Griha' }}</h2>
            <p style="font-size: 1.05rem; line-height: 1.7; color: var(--color-text-primary); margin-bottom: 1.25rem;">
                {{ $filosofi->inkulturasi ?? 'Gereja Paroki Santo Paulus Wonosobo dirancang dengan mengadopsi arsitektur tradisional Jawa Joglo Pangrawit Ceblokan yang sarat akan makna teologis.' }}
            </p>
            <div class="card-surface" style="border-left: 4px solid var(--color-accent); line-height: 1.7; font-size: 0.95rem;">
                {{ $filosofi->deskripsi_lengkap ?? 'Tata ruang gereja membawa umat dari ruang luar (pendopo/keterbukaan), melewati pringgitan (keheningan batin), hingga tiba di dalem suci (Goa Garba) tempat altar dan tabernakel bersemayam dalam keintiman hadirat Ilahi.' }}
            </div>
        </div>

        <div class="card-paroki" style="padding: 2.25rem; background: linear-gradient(135deg, var(--color-white), var(--color-surface));">
            <h3 style="font-size: 1.35rem; color: var(--color-primary); margin-bottom: 1rem;">
                <i class="fa-solid fa-tree" style="color: var(--color-accent); margin-right: 0.5rem;"></i> Ciri Khas Joglo Ceblokan
            </h3>
            <ul style="list-style: none; line-height: 1.8; font-size: 0.925rem; color: var(--color-text-primary);">
                <li style="margin-bottom: 0.75rem;">
                    <strong><i class="fa-solid fa-circle-check" style="color: var(--color-accent); margin-right: 0.5rem;"></i> Soko Guru Ceblokan:</strong> Empat tiang kayu jati utama yang tertanam kokoh pada umpak batu alam Wonosobo, melambangkan iman yang berakar pada Kristus.
                </li>
                <li style="margin-bottom: 0.75rem;">
                    <strong><i class="fa-solid fa-circle-check" style="color: var(--color-accent); margin-right: 0.5rem;"></i> Tumpang Sari Bertingkat:</strong> Susunan balok atap berundak melambangkan tingkatan pendakian rohani manusia menuju perjumpaan dengan Sang Pencipta.
                </li>
                <li>
                    <strong><i class="fa-solid fa-circle-check" style="color: var(--color-accent); margin-right: 0.5rem;"></i> Goa Garba (Rahim Rohani):</strong> Ruang panti imam yang terlindung dan teduh, melambangkan rahim Bunda Maria tempat Sang Sabda menjadi manusia.
                </li>
            </ul>
        </div>
    </div>

    <!-- 20 Simbol Arsitektur -->
    <div>
        <div style="text-align: center; max-width: 700px; margin: 0 auto 3rem auto;">
            <span class="badge-paroki badge-stasi" style="margin-bottom: 0.5rem;">Katekese Arsitektur</span>
            <h2 style="font-size: 2.25rem;">20 Simbol Arsitektur Gereja</h2>
            <p style="color: var(--color-text-secondary); font-size: 1rem;">
                Dua puluh ornamen dan struktur sakral yang berbicara tentang misteri iman Katolik dalam bahasa budaya Jawa.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
            @foreach($simbols as $sb)
                <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between; border-top: 4px solid var(--color-secondary);">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background-color: var(--color-primary); color: var(--color-accent); font-weight: 700; font-size: 0.85rem;">
                                {{ $sb->nomor_simbol }}
                            </span>
                            @if($sb->lokasi_pada_gereja)
                                <span style="font-size: 0.775rem; color: var(--color-text-secondary); background-color: var(--color-bg); padding: 0.2rem 0.5rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
                                    <i class="fa-solid fa-map-pin"></i> {{ $sb->lokasi_pada_gereja }}
                                </span>
                            @endif
                        </div>
                        <h3 style="font-size: 1.25rem; margin-bottom: 0.75rem; color: var(--color-primary);">{{ $sb->nama_simbol }}</h3>
                        
                        <div style="margin-bottom: 0.75rem;">
                            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-secondary); letter-spacing: 0.05em; margin-bottom: 0.2rem;">
                                Makna Filosofis Jawa:
                            </div>
                            <p style="font-size: 0.875rem; line-height: 1.6; color: var(--color-text-primary); margin: 0;">
                                {{ $sb->arti_filosofis }}
                            </p>
                        </div>

                        <div>
                            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-accent); letter-spacing: 0.05em; margin-bottom: 0.2rem;">
                                Nilai Teologis Kristiani:
                            </div>
                            <p style="font-size: 0.875rem; line-height: 1.6; color: var(--color-text-primary); margin: 0;">
                                {{ $sb->makna_teologis }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

