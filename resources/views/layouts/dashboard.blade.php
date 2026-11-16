<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem Informasi Paroki Santo Paulus Wonosobo</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-paroki.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/paroki-theme.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')
</head>
<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard.index') }}" style="display: flex; flex-direction: column; gap: 0.75rem; text-decoration: none;">
                    <!-- Baris 1: Dua logo berjejer horizontal -->
                    <div style="display: flex; align-items: center; gap: 11px;">
                        <img src="{{ asset('images/logo-paroki.png') }}" alt="Logo Paroki Santo Paulus Wonosobo" class="rounded-full object-cover" style="height: 46px; width: 46px; padding: 0; flex-shrink: 0;">
                        <img src="{{ asset('images/logo-omk.png') }}" alt="Logo OMK Wonosobo" style="height: 46px; width: 46px; object-fit: contain; background-color: #ffffff; border-radius: 50%; padding: 2px; border: 1.5px solid var(--color-accent); box-sizing: border-box; flex-shrink: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                    </div>
                    <!-- Baris 2: Teks identitas brand -->
                    <div>
                        <div style="font-family: var(--font-serif); font-size: 1.05rem; font-weight: 700; color: var(--color-white); line-height: 1.2;">ST. PAULUS</div>
                        <div style="font-size: 0.7rem; color: var(--color-accent); letter-spacing: 0.08em; font-weight: 600;">WONOSOBO ADMIN</div>
                    </div>
                </a>
                <div style="margin-top: 0.85rem; padding-top: 0.75rem; border-top: 1px solid rgba(255, 255, 255, 0.08); font-size: 0.8rem; color: #D3C7B9;">
                    <span style="font-weight: 600; color: var(--color-white);">{{ auth()->user()->name }}</span>
                    <div style="font-size: 0.725rem; color: var(--color-accent);">{{ auth()->user()->role->display_name ?? 'Pengguna' }}</div>
                </div>
            </div>

            <!-- Role-Based Navigation Menu -->
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge-high" style="width: 20px;"></i>
                        <span>Dashboard Utama</span>
                    </a>
                </li>

                {{-- MENU ADMIN SEKRETARIAT --}}
                @if(auth()->user()->isAdminSekretariat())
                    <li style="padding: 0.75rem 0.5rem 0.25rem 0.5rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--color-accent); letter-spacing: 0.05em;">
                        Administrasi Paroki
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal.index') }}" class="sidebar-link {{ request()->routeIs('admin.jadwal*') ? 'active' : '' }}">
                            <i class="fa-solid fa-calendar-days" style="width: 20px;"></i>
                            <span>Jadwal Ekaristi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.petugas.index') }}" class="sidebar-link {{ request()->routeIs('admin.petugas*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users-gear" style="width: 20px;"></i>
                            <span>Petugas Liturgi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.agenda.index') }}" class="sidebar-link {{ request()->routeIs('admin.agenda*') ? 'active' : '' }}">
                            <i class="fa-solid fa-clipboard-list" style="width: 20px;"></i>
                            <span>Agenda Kegiatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.warta.index') }}" class="sidebar-link {{ request()->routeIs('admin.warta*') ? 'active' : '' }}">
                            <i class="fa-solid fa-file-pdf" style="width: 20px;"></i>
                            <span>Warta Paroki</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-shield" style="width: 20px;"></i>
                            <span>Manajemen Pengguna</span>
                        </a>
                    </li>
                @endif

                {{-- MENU ROMO PAROKI --}}
                @if(auth()->user()->isRomoParoki())
                    <li style="padding: 0.75rem 0.5rem 0.25rem 0.5rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--color-accent); letter-spacing: 0.05em;">
                        Kerasulan Gembala
                    </li>
                    <li>
                        <a href="{{ route('romo.renungan.index') }}" class="sidebar-link {{ request()->routeIs('romo.renungan*') ? 'active' : '' }}">
                            <i class="fa-solid fa-book-bible" style="width: 20px;"></i>
                            <span>Renungan Gembala</span>
                        </a>
                    </li>
                @endif

                {{-- DATA MASTER PAROKI (SHARED UNTUK ADMIN DAN ROMO) --}}
                @if(auth()->user()->isAdminSekretariat() || auth()->user()->isRomoParoki())
                    <li style="padding: 0.75rem 0.5rem 0.25rem 0.5rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--color-accent); letter-spacing: 0.05em;">
                        Data Master Paroki
                    </li>
                    <li>
                        <a href="{{ route('master.profil') }}" class="sidebar-link {{ request()->routeIs('master.profil') ? 'active' : '' }}">
                            <i class="fa-solid fa-church" style="width: 20px;"></i>
                            <span>Profil Paroki</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('master.sejarah.index') }}" class="sidebar-link {{ request()->routeIs('master.sejarah*') ? 'active' : '' }}">
                            <i class="fa-solid fa-timeline" style="width: 20px;"></i>
                            <span>Sejarah Paroki</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('master.arsitektur') }}" class="sidebar-link {{ request()->routeIs('master.arsitektur*') ? 'active' : '' }}">
                            <i class="fa-solid fa-landmark" style="width: 20px;"></i>
                            <span>Filosofi & 20 Simbol</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('master.pastor.index') }}" class="sidebar-link {{ request()->routeIs('master.pastor*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-tie" style="width: 20px;"></i>
                            <span>Data Pastor</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('master.lingkungan.index') }}" class="sidebar-link {{ request()->routeIs('master.lingkungan*') ? 'active' : '' }}">
                            <i class="fa-solid fa-map-location-dot" style="width: 20px;"></i>
                            <span>14 Lingkungan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('master.stasi.index') }}" class="sidebar-link {{ request()->routeIs('master.stasi*') ? 'active' : '' }}">
                            <i class="fa-solid fa-building-columns" style="width: 20px;"></i>
                            <span>7 Stasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('master.kategorial.index') }}" class="sidebar-link {{ request()->routeIs('master.kategorial*') ? 'active' : '' }}">
                            <i class="fa-solid fa-people-group" style="width: 20px;"></i>
                            <span>Organisasi Kategorial</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('master.sakramen.index') }}" class="sidebar-link {{ request()->routeIs('master.sakramen*') ? 'active' : '' }}">
                            <i class="fa-solid fa-hands-praying" style="width: 20px;"></i>
                            <span>Informasi Sakramen</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.audit_logs') }}" class="sidebar-link {{ request()->routeIs('admin.audit_logs') ? 'active' : '' }}">
                            <i class="fa-solid fa-shield-halved" style="width: 20px;"></i>
                            <span>Audit Log</span>
                        </a>
                    </li>
                @endif

                {{-- MENU TIM KOMSOS / OMK --}}
                @if(auth()->user()->isTimKomsos())
                    <li style="padding: 0.75rem 0.5rem 0.25rem 0.5rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--color-accent); letter-spacing: 0.05em;">
                        Media Komsos & OMK
                    </li>
                    <li>
                        <a href="{{ route('komsos.berita.index') }}" class="sidebar-link {{ request()->routeIs('komsos.berita*') ? 'active' : '' }}">
                            <i class="fa-solid fa-newspaper" style="width: 20px;"></i>
                            <span>Berita Paroki</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('komsos.kategori.index') }}" class="sidebar-link {{ request()->routeIs('komsos.kategori*') ? 'active' : '' }}">
                            <i class="fa-solid fa-tags" style="width: 20px;"></i>
                            <span>Kategori Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('komsos.galeri.index') }}" class="sidebar-link {{ request()->routeIs('komsos.galeri*') ? 'active' : '' }}">
                            <i class="fa-solid fa-images" style="width: 20px;"></i>
                            <span>Galeri & Foto</span>
                        </a>
                    </li>
                @endif
            </ul>

            <div style="padding: 1rem 1.25rem; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-paroki btn-secondary" style="width: 100%; justify-content: center; font-size: 0.85rem; padding: 0.5rem;">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar (Logout)
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Body -->
        <div class="dashboard-main">
            <!-- Topbar -->
            <header class="dashboard-topbar">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <button id="sidebarToggleBtn" aria-label="Toggle Sidebar" style="display: none; background: none; border: 1px solid var(--color-border); padding: 0.4rem 0.65rem; border-radius: var(--radius-md); cursor: pointer; color: var(--color-primary);">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div style="font-size: 0.9rem; color: var(--color-text-secondary);">
                        <a href="{{ route('public.index') }}" target="_blank" style="color: var(--color-primary); font-weight: 500;">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Website Publik
                        </a>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 1.25rem;">
                    <div style="text-align: right;">
                        <div style="font-weight: 600; font-size: 0.875rem; color: var(--color-primary);">{{ auth()->user()->name }}</div>
                        <div style="font-size: 0.75rem; color: var(--color-text-secondary);">{{ auth()->user()->role->display_name ?? 'User' }}</div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="dashboard-content">
                <!-- Flash Alerts -->
                @if(session('success'))
                    <div class="alert-paroki alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-paroki alert-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-paroki alert-danger" style="display: block;">
                        <div style="font-weight: 600; margin-bottom: 0.35rem;"><i class="fa-solid fa-circle-exclamation"></i> Terdapat kesalahan pengisian data:</div>
                        <ul style="margin-left: 1.5rem; font-size: 0.85rem;">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggleBtn');
        const sidebar = document.querySelector('.dashboard-sidebar');

        function checkScreen() {
            if (window.innerWidth <= 991) {
                sidebarToggle.style.display = 'block';
                sidebar.style.display = 'none';
            } else {
                sidebarToggle.style.display = 'none';
                sidebar.style.display = 'flex';
            }
        }

        sidebarToggle.addEventListener('click', function() {
            if (sidebar.style.display === 'none') {
                sidebar.style.display = 'flex';
            } else {
                sidebar.style.display = 'none';
            }
        });

        window.addEventListener('resize', checkScreen);
        checkScreen();
    </script>
    @stack('scripts')
</body>
</html>

