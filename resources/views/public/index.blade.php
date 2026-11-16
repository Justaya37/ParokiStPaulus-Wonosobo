@extends('layouts.public')

@section('title', 'Beranda - Paroki Santo Paulus Wonosobo')

@section('content')
<!-- Hero Section -->
<section class="hero-paroki" style="background-image: linear-gradient(to right, rgba(35, 23, 16, 0.75) 0%, rgba(53, 38, 28, 0.65) 50%, rgba(40, 28, 20, 0.40) 100%), url('{{ asset('images/gereja-tampak-depan.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
    <div class="container" style="position: relative; z-index: 2;">
        <div style="max-width: 800px;">
            <div style="display: inline-block; background-color: rgba(182, 154, 104, 0.25); border: 1px solid var(--color-accent); padding: 0.35rem 0.85rem; border-radius: var(--radius-md); font-size: 0.85rem; font-weight: 600; color: #F5EADB; margin-bottom: 1rem; letter-spacing: 0.05em; backdrop-filter: blur(4px);">
                <i class="fa-solid fa-cross" style="color: var(--color-accent); margin-right: 0.35rem;"></i> KEUSKUPAN PURWOKERTO
            </div>
            <h1>Gereja Katolik Santo Paulus Wonosobo</h1>
            <p>
                Gereja berarsitektur <em>Joglo Pangrawit Ceblokan</em> dengan filosofi <em>Goa Garba</em>. Rumah perjumpaan iman yang hangat, teduh, bersaudara, dan berakar pada kearifan budaya lokal di lereng bumi Wonosobo.
            </p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('public.jadwal') }}" class="btn-paroki btn-accent" style="padding: 0.75rem 1.5rem; font-size: 1rem; box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35);">
                    <i class="fa-solid fa-clock"></i> Jadwal Ekaristi
                </a>
                <a href="{{ route('public.arsitektur') }}" class="btn-paroki btn-secondary" style="padding: 0.75rem 1.5rem; font-size: 1rem; background-color: rgba(255, 255, 255, 0.18); color: #fff; border-color: rgba(255, 255, 255, 0.35); backdrop-filter: blur(4px); box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);">
                    <i class="fa-solid fa-landmark"></i> 20 Simbol Joglo
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Quick Mass Schedule & Info Banner -->
<section style="background-color: var(--color-white); border-bottom: 1px solid var(--color-border); padding: 2.5rem 0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge-paroki badge-utama" style="margin-bottom: 0.35rem;">Liturgi Kudus</span>
                <h2 style="font-size: 1.75rem;">Jadwal Ekaristi Mendatang</h2>
            </div>
            <a href="{{ route('public.jadwal') }}" class="btn-paroki btn-secondary btn-sm">
                Lihat Seluruh Jadwal (Gereja Utama & 7 Stasi) <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem;">
            @forelse($jadwalUtama->take(3) as $j)
                <div class="card-paroki" style="border-left: 4px solid var(--color-primary);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge-paroki badge-utama">Gereja Utama Wonosobo</span>
                        <span style="font-size: 0.8rem; color: var(--color-text-secondary);"><i class="fa-solid fa-language"></i> {{ $j->bahasa }}</span>
                    </div>
                    <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">{{ $j->nama_perayaan }}</h3>
                    <div style="font-size: 1.15rem; font-weight: 700; color: var(--color-secondary); margin-bottom: 0.5rem;">
                        <i class="fa-regular fa-calendar-check" style="color: var(--color-accent); margin-right: 0.35rem;"></i>
                        {{ $j->hari ?? ($j->tanggal ? $j->tanggal->isoFormat('D MMMM Y') : 'Jadwal') }} &bull; {{ date('H:i', strtotime($j->waktu_mulai)) }} WIB
                    </div>
                    @if($j->keterangan)
                        <p style="font-size: 0.85rem; color: var(--color-text-secondary); margin: 0;">{{ $j->keterangan }}</p>
                    @endif
                </div>
            @empty
                <div class="card-surface" style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                    <p style="color: var(--color-text-secondary); margin: 0;">Jadwal Ekaristi sedang disesuaikan oleh Sekretariat Paroki.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Sambutan Pastor & Filosofi Singkat -->
<section class="section-py">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem; align-items: center;">
            <!-- Profil Singkat -->
            <div>
                <span class="badge-paroki badge-utama" style="margin-bottom: 0.5rem;">Tentang Paroki</span>
                <h2 style="font-size: 2.25rem; margin-bottom: 1.25rem;">Rumah Rohani di Lereng Dieng</h2>
                <p style="font-size: 1.05rem; line-height: 1.7; color: var(--color-text-primary); margin-bottom: 1.25rem;">
                    {{ $profil->deskripsi_singkat ?? 'Gereja Paroki Santo Paulus Wonosobo menyatukan persekutuan umat di 14 lingkungan kota dan 7 stasi lereng pegunungan. Arsitektur Joglo Pangrawit Ceblokan menghadirkan suasana doa yang teduh dan membumi.' }}
                </p>
                <div class="card-surface" style="margin-bottom: 1.5rem; border-left: 4px solid var(--color-accent);">
                    <div style="font-style: italic; font-size: 0.95rem; line-height: 1.6; color: var(--color-text-primary); margin-bottom: 0.75rem;">
                        "{{ $profil->sambutan_pastor ?? 'Berkah Dalem. Selamat datang di portal resmi Paroki Santo Paulus Wonosobo.' }}"
                    </div>
                    <div style="font-weight: 700; font-size: 0.875rem; color: var(--color-primary);">
                        &mdash; Pastor Kepala Paroki Santo Paulus Wonosobo
                    </div>
                </div>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('public.profil') }}" class="btn-paroki btn-primary">
                        <i class="fa-solid fa-book-open"></i> Profil & Sejarah Lengkap
                    </a>
                    <a href="{{ route('public.lingkungan_stasi') }}" class="btn-paroki btn-secondary">
                        <i class="fa-solid fa-map-location-dot"></i> 14 Lingkungan & 7 Stasi
                    </a>
                </div>
            </div>

            <!-- 20 Simbol Arsitektur Preview Card -->
            <div class="card-paroki" style="padding: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                    <span class="badge-paroki badge-stasi">Inkulturasi Jawa - Katolik</span>
                    <span style="font-size: 0.85rem; font-weight: 600; color: var(--color-accent);">20 Simbol Arsitektur</span>
                </div>
                <h3 style="font-size: 1.5rem; margin-bottom: 0.75rem;">Joglo Pangrawit & Goa Garba</h3>
                <p style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.5rem;">
                    Setiap ornamen dan struktur tiang soko guru di dalam gedung gereja memiliki makna filosofis Jawa luhur yang bermuara pada teologi keselamatan Kristiani.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1.5rem;">
                    @foreach($simbolPreview as $sb)
                        <div style="background-color: var(--color-bg); padding: 0.75rem; border-radius: var(--radius-md); border: 1px solid var(--color-border);">
                            <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-accent);">#{{ $sb->nomor_simbol }}</div>
                            <div style="font-weight: 600; font-size: 0.85rem; color: var(--color-primary);">{{ $sb->nama_simbol }}</div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('public.arsitektur') }}" class="btn-paroki btn-accent" style="width: 100%;">
                    Jelajahi Seluruh 20 Simbol Gereja <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Warta Paroki & Renungan Section -->
<section style="background-color: var(--color-surface); padding: 4rem 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
            <!-- Renungan Gembala Terbaru -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <h2 style="font-size: 1.75rem;">Sapaan Gembala</h2>
                    <a href="{{ route('public.renungan') }}" style="font-size: 0.875rem; font-weight: 600;">Lihat Semua <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                @if($renunganTerbaru)
                    <div class="card-paroki" style="height: calc(100% - 2.5rem); display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                <span class="badge-paroki badge-published"><i class="fa-solid fa-scroll" style="margin-right: 0.35rem;"></i> Renungan Mingguan</span>
                                <span style="font-size: 0.8rem; color: var(--color-text-secondary);">{{ $renunganTerbaru->tanggal_renungan ? $renunganTerbaru->tanggal_renungan->isoFormat('D MMMM Y') : '' }}</span>
                            </div>
                            <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem;">
                                <a href="{{ route('public.renungan.detail', $renunganTerbaru->slug) }}">{{ $renunganTerbaru->judul }}</a>
                            </h3>
                            @if($renunganTerbaru->ayat_bacaan)
                                <div style="font-size: 0.85rem; font-weight: 600; color: var(--color-accent); margin-bottom: 0.75rem;">
                                    <i class="fa-solid fa-book-bible"></i> {{ $renunganTerbaru->ayat_bacaan }}
                                </div>
                            @endif
                            <p style="font-size: 0.925rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1rem;">
                                {{ Str::limit(strip_tags($renunganTerbaru->isi), 180) }}
                            </p>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--color-border); padding-top: 0.75rem; font-size: 0.85rem;">
                            <span style="color: var(--color-secondary); font-weight: 600;">{{ $renunganTerbaru->author->name ?? 'Romo Paroki' }}</span>
                            <a href="{{ route('public.renungan.detail', $renunganTerbaru->slug) }}" class="btn-paroki btn-secondary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                @else
                    <div class="card-paroki" style="text-align: center; padding: 2.5rem;">
                        <p style="color: var(--color-text-secondary);">Renungan gembala edisi terbaru akan segera dipublikasikan.</p>
                    </div>
                @endif
            </div>

            <!-- Unduh Warta Paroki Mingguan -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <h2 style="font-size: 1.75rem;">Warta Paroki Digital</h2>
                    <a href="{{ route('public.warta') }}" style="font-size: 0.875rem; font-weight: 600;">Arsip Warta <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                @if($wartaTerbaru)
                    <div class="card-paroki" style="height: calc(100% - 2.5rem); display: flex; flex-direction: column; justify-content: space-between; border-top: 4px solid var(--color-secondary);">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                <span class="badge-paroki badge-utama"><i class="fa-solid fa-file-pdf" style="margin-right: 0.35rem;"></i> Dokumen Resmi</span>
                                <span style="font-size: 0.8rem; color: var(--color-text-secondary);">Terbit: {{ $wartaTerbaru->tanggal_terbit ? $wartaTerbaru->tanggal_terbit->isoFormat('D MMMM Y') : '' }}</span>
                            </div>
                            <h3 style="font-size: 1.35rem; margin-bottom: 0.5rem;">{{ $wartaTerbaru->judul }}</h3>
                            <div style="font-size: 0.875rem; font-weight: 600; color: var(--color-primary); margin-bottom: 0.75rem;">
                                Edisi: {{ $wartaTerbaru->edisi }}
                            </div>
                            <p style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
                                {{ $wartaTerbaru->deskripsi ?? 'Lembar pengumuman liturgi, warta keuangan, intensi misa, dan kegiatan pastoral Paroki Santo Paulus Wonosobo.' }}
                            </p>
                        </div>
                        <div style="border-top: 1px solid var(--color-border); padding-top: 1rem; display: flex; gap: 0.75rem; flex-wrap: wrap;">
                            <a href="{{ route('public.warta.download', $wartaTerbaru->id) }}" class="btn-paroki btn-primary" style="flex: 1;">
                                <i class="fa-solid fa-download"></i> Unduh Warta (PDF)
                            </a>
                            <a href="{{ route('public.warta') }}" class="btn-paroki btn-secondary">
                                Semua Edisi
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card-paroki" style="text-align: center; padding: 2.5rem;">
                        <p style="color: var(--color-text-secondary);">Berkas Warta Paroki mingguan sedang disiapkan sekretariat.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Berita Paroki & Agenda Mendatang -->
<section class="section-py">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge-paroki badge-stasi" style="margin-bottom: 0.35rem;">Kabar Umat</span>
                <h2 style="font-size: 2rem;">Warta Berita Terkini</h2>
            </div>
            <a href="{{ route('public.berita') }}" class="btn-paroki btn-secondary btn-sm">
                Lihat Seluruh Berita <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
            @forelse($beritas as $b)
                <div class="card-paroki" style="display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <span class="badge-paroki badge-utama">{{ $b->kategori->nama_kategori ?? 'Warta Paroki' }}</span>
                            <span style="font-size: 0.8rem; color: var(--color-text-secondary);">{{ $b->published_at ? $b->published_at->isoFormat('D MMM Y') : '' }}</span>
                        </div>
                        <h3 style="font-size: 1.25rem; margin-bottom: 0.75rem; line-height: 1.35;">
                            <a href="{{ route('public.berita.detail', $b->slug) }}">{{ $b->judul }}</a>
                        </h3>
                        <p style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
                            {{ $b->ringkasan ?? Str::limit(strip_tags($b->isi), 120) }}
                        </p>
                    </div>
                    <div style="border-top: 1px solid var(--color-border); padding-top: 0.75rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.825rem; color: var(--color-text-secondary);">
                        <span><i class="fa-solid fa-pen-nib"></i> {{ $b->author->name ?? 'Tim Komsos' }}</span>
                        <a href="{{ route('public.berita.detail', $b->slug) }}" style="font-weight: 600;">Baca <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            @empty
                <div class="card-surface" style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                    <p style="color: var(--color-text-secondary); margin: 0;">Belum ada artikel berita yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Galeri Foto Preview -->
<section style="background-color: var(--color-white); border-top: 1px solid var(--color-border); padding: 4rem 0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge-paroki badge-utama" style="margin-bottom: 0.35rem;">Dokumentasi Paroki</span>
                <h2 style="font-size: 2rem;">Galeri Kegiatan Umat</h2>
            </div>
            <a href="{{ route('public.galeri') }}" class="btn-paroki btn-secondary btn-sm">
                Lihat Seluruh Album Foto <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="galeri-grid-3">
            @forelse($galeriAlbums as $alb)
                @php
                    $coverUrl = $alb->cover_url;
                @endphp
                <a href="{{ route('public.galeri.detail', $alb->slug) }}" class="card-paroki" style="text-decoration: none; display: flex; flex-direction: column; overflow: hidden; padding: 0; border-radius: var(--radius-lg);">
                    <div class="aspect-4-3">
                        @if($coverUrl)
                            <img src="{{ $coverUrl }}" alt="{{ $alb->judul }}" class="galeri-img-cover">
                        @else
                            <div class="galeri-placeholder">
                                <i class="fa-solid fa-images" style="font-size: 2.75rem; opacity: 0.45; margin-bottom: 0.5rem;"></i>
                                <span style="font-size: 0.8rem; font-weight: 600; opacity: 0.7;">Dokumentasi Paroki</span>
                            </div>
                        @endif
                    </div>
                    <div style="padding: 1.25rem; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <span style="font-size: 0.75rem; color: var(--color-text-secondary); font-weight: 600;">
                                    <i class="fa-regular fa-calendar" style="margin-right: 0.25rem;"></i> {{ $alb->tanggal_kegiatan ? $alb->tanggal_kegiatan->isoFormat('D MMM Y') : 'Dokumentasi' }}
                                </span>
                                <span class="badge-paroki badge-stasi" style="font-size: 0.7rem; padding: 0.2rem 0.5rem;">{{ $alb->fotos->count() }} Foto</span>
                            </div>
                            <h4 style="font-size: 1.15rem; color: var(--color-primary); margin-bottom: 0.35rem; line-height: 1.35;">{{ $alb->judul }}</h4>
                            @if($alb->deskripsi)
                                <p style="font-size: 0.85rem; color: var(--color-text-secondary); line-height: 1.5; margin: 0;">
                                    {{ Str::limit($alb->deskripsi, 85) }}
                                </p>
                            @endif
                        </div>
                        <div style="margin-top: 1rem; text-align: right;">
                            <span style="font-size: 0.825rem; font-weight: 600; color: var(--color-secondary);">
                                Buka Album <i class="fa-solid fa-chevron-right" style="font-size: 0.75rem; margin-left: 0.2rem;"></i>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="card-surface" style="grid-column: 1/-1; text-align: center; padding: 3rem;">
                    <i class="fa-solid fa-camera-retro" style="font-size: 2.5rem; color: var(--color-secondary); opacity: 0.4; margin-bottom: 0.75rem;"></i>
                    <p style="color: var(--color-text-secondary); margin: 0;">Album galeri foto akan segera diperbarui oleh Tim Komsos.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

