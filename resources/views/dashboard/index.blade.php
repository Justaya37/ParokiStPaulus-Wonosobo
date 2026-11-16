@extends('layouts.dashboard')

@section('title', 'Dashboard Utama')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; margin-bottom: 0.35rem;">Selamat Datang, {{ auth()->user()->name }}</h1>
    <p style="color: var(--color-text-secondary); margin: 0;">
        Peran: <strong>{{ auth()->user()->role->display_name }}</strong> &bull; Sistem Informasi & Profil Paroki Santo Paulus Wonosobo
    </p>
</div>

<!-- Statistik Ringkas Berdasarkan Wewenang -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
    @if(auth()->user()->isAdminSekretariat())
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Jadwal Misa Aktif</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">{{ $stats['total_jadwal'] }}</div>
            <a href="{{ route('admin.jadwal.index') }}" style="font-size: 0.8rem; font-weight: 600;">Kelola Jadwal &rarr;</a>
        </div>
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Lingkungan / Stasi</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">{{ $stats['total_lingkungan'] }} / {{ $stats['total_stasi'] }}</div>
            <a href="{{ route('master.lingkungan.index') }}" style="font-size: 0.8rem; font-weight: 600;">Data Master &rarr;</a>
        </div>
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Warta Paroki Terbit</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">{{ $stats['total_warta'] }}</div>
            <a href="{{ route('admin.warta.index') }}" style="font-size: 0.8rem; font-weight: 600;">Kelola Berkas PDF &rarr;</a>
        </div>
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Pengguna Sistem</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">{{ $stats['total_users'] }}</div>
            <a href="{{ route('admin.users.index') }}" style="font-size: 0.8rem; font-weight: 600;">Manajemen Akun &rarr;</a>
        </div>
    @endif

    @if(auth()->user()->isRomoParoki())
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Total Renungan</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">{{ $stats['total_renungan'] }}</div>
            <a href="{{ route('romo.renungan.index') }}" style="font-size: 0.8rem; font-weight: 600;">Buka Renungan &rarr;</a>
        </div>
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Draft Tersimpan</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-warning); margin: 0.25rem 0;">{{ $stats['total_renungan_draft'] }}</div>
            <a href="{{ route('romo.renungan.index') }}" style="font-size: 0.8rem; font-weight: 600;">Lanjutkan Menulis &rarr;</a>
        </div>
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Data Master Paroki</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">8 Modul</div>
            <a href="{{ route('master.profil') }}" style="font-size: 0.8rem; font-weight: 600;">Kelola Profil & Master &rarr;</a>
        </div>
    @endif

    @if(auth()->user()->isTimKomsos())
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Total Berita</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">{{ $stats['total_berita'] }}</div>
            <a href="{{ route('komsos.berita.index') }}" style="font-size: 0.8rem; font-weight: 600;">Buka Berita &rarr;</a>
        </div>
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Draft Berita</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-warning); margin: 0.25rem 0;">{{ $stats['total_berita_draft'] }}</div>
            <a href="{{ route('komsos.berita.index') }}" style="font-size: 0.8rem; font-weight: 600;">Edit Draft &rarr;</a>
        </div>
        <div class="card-paroki">
            <div style="font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase;">Album Galeri</div>
            <div style="font-size: 2.25rem; font-weight: 700; color: var(--color-primary); margin: 0.25rem 0;">{{ $stats['total_galeri'] }}</div>
            <a href="{{ route('komsos.galeri.index') }}" style="font-size: 0.8rem; font-weight: 600;">Kelola Foto &rarr;</a>
        </div>
    @endif
</div>

<!-- Informasi Operasional Tambahan -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
    <!-- Jadwal Terdaftar -->
    <div class="card-paroki">
        <h3 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--color-primary);">Jadwal Misa Aktif Terbaru</h3>
        <ul style="list-style: none; font-size: 0.875rem; line-height: 1.8;">
            @forelse($recentJadwals as $rj)
                <li style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--color-border); padding: 0.4rem 0;">
                    <div>
                        <strong>{{ $rj->nama_perayaan }}</strong>
                        <div style="font-size: 0.775rem; color: var(--color-text-secondary);">
                            {{ $rj->stasi ? $rj->stasi->nama_stasi : 'Gereja Utama' }} &bull; {{ $rj->hari ?? $rj->tanggal?->format('d/m/Y') }}
                        </div>
                    </div>
                    <span style="font-weight: 700; color: var(--color-secondary);">{{ date('H:i', strtotime($rj->waktu_mulai)) }} WIB</span>
                </li>
            @empty
                <li style="color: var(--color-text-secondary);">Belum ada jadwal yang dimasukkan.</li>
            @endforelse
        </ul>
    </div>

    <!-- Aktivitas Audit Log Terbaru -->
    @if(auth()->user()->isAdminSekretariat() || auth()->user()->isRomoParoki())
        <div class="card-paroki">
            <h3 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--color-primary);">Catatan Aktivitas Terkini (Audit Log)</h3>
            <ul style="list-style: none; font-size: 0.85rem; line-height: 1.7;">
                @forelse($recentAudits as $ra)
                    <li style="border-bottom: 1px solid var(--color-border); padding: 0.4rem 0;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="badge-paroki {{ $ra->aksi === 'DELETE' ? 'badge-draft' : 'badge-utama' }}" style="font-size: 0.7rem;">
                                {{ $ra->aksi }}
                            </span>
                            <span style="font-size: 0.75rem; color: var(--color-text-secondary);">
                                {{ $ra->created_at ? $ra->created_at->diffForHumans() : '' }}
                            </span>
                        </div>
                        <div style="margin-top: 0.25rem;">
                            <strong>{{ $ra->entitas }}</strong> oleh <em>{{ $ra->user->name ?? 'Sistem' }}</em> ({{ $ra->role_name }})
                        </div>
                    </li>
                @empty
                    <li style="color: var(--color-text-secondary);">Belum ada catatan aktivitas di log audit.</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
@endsection

