<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Paroki Santo Paulus Wonosobo') - Keuskupan Purwokerto</title>
    <meta name="description" content="@yield('meta_description', 'Website Resmi Paroki Santo Paulus Wonosobo - Gereja Katolik berarsitektur Joglo Pangrawit Ceblokan dan spiritualitas Goa Garba di Wonosobo.')">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-paroki.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/paroki-theme.css') }}?v={{ file_exists(public_path('css/paroki-theme.css')) ? filemtime(public_path('css/paroki-theme.css')) : time() }}">
    <!-- Inline helpers for mobile navigation & icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Responsive Mobile Header & Navigation Enforcement */
        @media (max-width: 991px) {
            .paroki-navbar {
                position: sticky !important;
                top: 0 !important;
                z-index: 1000 !important;
            }
            .navbar-container {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                flex-wrap: wrap !important;
                position: relative !important;
                padding-top: 0.6rem !important;
                padding-bottom: 0.6rem !important;
            }
            .navbar-brand {
                display: flex !important;
                align-items: center !important;
                gap: 0.45rem !important;
                max-width: calc(100% - 56px) !important;
            }
            .navbar-brand .brand-logo {
                height: 34px !important;
                width: 34px !important;
                flex-shrink: 0 !important;
            }
            .navbar-brand .brand-title {
                font-size: 14.5px !important;
                line-height: 1.15 !important;
                white-space: nowrap !important;
            }
            .navbar-brand .brand-subtitle {
                font-size: 10.5px !important;
                letter-spacing: 0.08em !important;
            }
            .mobile-menu-toggle {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                margin-left: auto !important;
            }
            .navbar-nav {
                display: none !important;
                position: absolute !important;
                top: 100% !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                background-color: #ffffff !important;
                border-top: 1px solid var(--color-border) !important;
                border-bottom: 1px solid var(--color-border) !important;
                box-shadow: 0 14px 28px rgba(53, 40, 32, 0.16), 0 4px 10px rgba(53, 40, 32, 0.08) !important;
                padding: 0.85rem 1.25rem 1.25rem !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 0.35rem !important;
                max-height: calc(100vh - 75px) !important;
                overflow-y: auto !important;
                z-index: 9999 !important;
            }
            .navbar-nav.mobile-active {
                display: flex !important;
                animation: dropdownFade 0.2s ease forwards !important;
            }
            .navbar-nav .nav-link {
                width: 100% !important;
                display: block !important;
                padding: 0.65rem 0.85rem !important;
                font-size: 0.925rem !important;
                border-radius: var(--radius-md) !important;
                border-bottom: 1px solid rgba(221, 209, 194, 0.35) !important;
                text-align: left !important;
            }
            .navbar-nav .nav-link:last-of-type {
                border-bottom: none !important;
            }
            .navbar-nav .nav-dropdown {
                width: 100% !important;
                margin-top: 0.35rem !important;
                position: static !important;
            }
            .navbar-nav .nav-dropdown-toggle {
                width: 100% !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                padding: 0.65rem 0.85rem !important;
                font-size: 0.925rem !important;
            }
            .navbar-nav .nav-dropdown-menu {
                position: static !important;
                box-shadow: none !important;
                border: 1px solid var(--color-border) !important;
                margin-top: 0.4rem !important;
                width: 100% !important;
                border-radius: var(--radius-md) !important;
                background-color: var(--color-surface) !important;
                padding: 0.35rem 0 !important;
                display: none;
            }
            .navbar-nav .nav-dropdown.is-open .nav-dropdown-menu {
                display: block !important;
            }
            .navbar-nav .dropdown-item-paroki {
                width: 100% !important;
                padding: 0.65rem 0.85rem !important;
                font-size: 0.875rem !important;
                text-align: left !important;
            }
            .topbar-address {
                display: none !important;
            }
            .topbar-container {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                flex-wrap: nowrap !important;
                gap: 0.5rem !important;
            }
        }
        @media (max-width: 640px) {
            .paroki-topbar {
                padding: 0.3rem 0 !important;
                font-size: 0.775rem !important;
            }
            .topbar-phone {
                display: none !important;
            }
            .topbar-contacts {
                display: flex !important;
                align-items: center !important;
                gap: 0.5rem !important;
            }
            .navbar-brand .brand-logo {
                height: 32px !important;
                width: 32px !important;
            }
            .navbar-brand .brand-title {
                font-size: 13.5px !important;
            }
            .navbar-brand .brand-subtitle {
                font-size: 10px !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Top Bar -->
    <div class="paroki-topbar">
        <div class="container topbar-container">
            <div class="topbar-contacts">
                <span class="topbar-phone"><i class="fa-solid fa-phone" style="margin-right: 0.35rem; color: var(--color-accent);"></i> (0286) 321xxx</span>
                <span class="topbar-wa"><i class="fa-brands fa-whatsapp" style="margin-right: 0.35rem; color: #4ade80;"></i> 0812-3456-7890</span>
                <span class="topbar-address"><i class="fa-solid fa-location-dot" style="margin-right: 0.35rem; color: var(--color-accent);"></i> Jl. Letjen S. Parman No. 2, Wonosobo</span>
            </div>
            <div class="topbar-auth">
                @auth
                    <a href="{{ route('dashboard.index') }}" style="font-weight: 600;"><i class="fa-solid fa-gauge-high"></i> Dashboard ({{ auth()->user()->role->display_name ?? 'Staf' }})</a>
                @else
                    <a href="{{ route('login') }}"><i class="fa-solid fa-lock" style="margin-right: 0.35rem;"></i> Masuk Staf / Romo</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="paroki-navbar">
        <div class="container navbar-container">
            <!-- Brand / Logo -->
            <a href="{{ route('public.index') }}" class="navbar-brand">
                <img src="{{ asset('images/logo-paroki.png') }}" alt="Logo Paroki Santo Paulus Wonosobo" class="brand-logo rounded-full object-cover" style="padding: 0;">
                <img src="{{ asset('images/logo-omk.png') }}" alt="Logo OMK Wonosobo" class="brand-logo" style="object-fit: contain;">
                <div class="brand-text">
                    <div class="brand-title">PAROKI SANTO PAULUS</div>
                    <div class="brand-subtitle">WONOSOBO</div>
                </div>
            </a>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobileMenuBtn" class="mobile-menu-toggle" aria-label="Buka Menu" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Desktop / Mobile Nav Links -->
            <nav id="mainNav" class="navbar-nav">
                <a href="{{ route('public.index') }}" class="nav-link {{ request()->routeIs('public.index') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('public.profil') }}" class="nav-link {{ request()->routeIs('public.profil') ? 'active' : '' }}">Profil & Sejarah</a>
                <a href="{{ route('public.pastor') }}" class="nav-link {{ request()->routeIs('public.pastor') ? 'active' : '' }}">Pastor</a>
                <a href="{{ route('public.jadwal') }}" class="nav-link {{ request()->routeIs('public.jadwal') ? 'active' : '' }}" style="font-weight: 600; color: var(--color-primary);">Jadwal Misa</a>
                <a href="{{ route('public.agenda') }}" class="nav-link {{ request()->routeIs('public.agenda*') ? 'active' : '' }}">Agenda</a>
                <a href="{{ route('public.berita') }}" class="nav-link {{ request()->routeIs('public.berita*') ? 'active' : '' }}">Berita</a>
                <a href="{{ route('public.renungan') }}" class="nav-link {{ request()->routeIs('public.renungan*') ? 'active' : '' }}">Renungan</a>
                <a href="{{ route('public.galeri') }}" class="nav-link {{ request()->routeIs('public.galeri*') ? 'active' : '' }}">Galeri</a>
                
                <!-- Akses Cepat Dropdown with Chevron Down -->
                <div class="nav-dropdown" id="quickAccessDropdown">
                    <button type="button" class="nav-dropdown-toggle {{ request()->routeIs('public.warta*', 'public.arsitektur*', 'public.sakramen*', 'public.lingkungan_stasi*') ? 'active' : '' }}" id="quickAccessBtn" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-compass" style="color: var(--color-accent); font-size: 0.9rem;"></i>
                        <span>Akses Cepat</span>
                        <i class="fa-solid fa-chevron-down chevron-icon"></i>
                    </button>
                    <div class="nav-dropdown-menu" id="quickAccessMenu">
                        <div class="dropdown-header-paroki">Akses Cepat Informasi</div>
                        <a href="{{ route('public.jadwal') }}" class="dropdown-item-paroki {{ request()->routeIs('public.jadwal*') ? 'active' : '' }}">
                            <i class="fa-regular fa-calendar-check"></i>
                            <span>Jadwal Perayaan Ekaristi</span>
                        </a>
                        <a href="{{ route('public.warta') }}" class="dropdown-item-paroki {{ request()->routeIs('public.warta*') ? 'active' : '' }}">
                            <i class="fa-regular fa-file-pdf"></i>
                            <span>Lembar Warta Paroki (PDF)</span>
                        </a>
                        <a href="{{ route('public.arsitektur') }}" class="dropdown-item-paroki {{ request()->routeIs('public.arsitektur*') ? 'active' : '' }}">
                            <i class="fa-solid fa-landmark"></i>
                            <span>20 Simbol Arsitektur Joglo</span>
                        </a>
                        <a href="{{ route('public.sakramen') }}" class="dropdown-item-paroki {{ request()->routeIs('public.sakramen*') ? 'active' : '' }}">
                            <i class="fa-solid fa-book-bible"></i>
                            <span>Persyaratan & Panduan Sakramen</span>
                        </a>
                        <a href="{{ route('public.lingkungan_stasi') }}" class="dropdown-item-paroki {{ request()->routeIs('public.lingkungan_stasi*') ? 'active' : '' }}">
                            <i class="fa-solid fa-sitemap"></i>
                            <span>14 Lingkungan & 7 Stasi</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Body Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="paroki-footer">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2.5rem; margin-bottom: 2.5rem;">
                <!-- Col 1: About Paroki -->
                <div>
                    <h4 style="font-size: 1.25rem;">Paroki Santo Paulus Wonosobo</h4>
                    <p style="font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem; color: #D1C5B6;">
                        Gereja Katolik di tanah Wonosobo dengan warisan arsitektur Joglo Pangrawit Ceblokan dan spiritualitas Goa Garba. Rumah ibadat inklusif, hangat, dan berakar pada budaya lokal.
                    </p>
                    <p style="font-size: 0.85rem; color: #B3A494;">
                        Pelindung: <strong>Santo Paulus Rasul</strong><br>
                        Keuskupan: <strong>Keuskupan Purwokerto</strong>
                    </p>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h4 style="font-size: 1.15rem;">Akses Cepat Informasi</h4>
                    <ul style="list-style: none; font-size: 0.9rem; line-height: 2;">
                        <li><a href="{{ route('public.jadwal') }}"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem; color: var(--color-accent);"></i> Jadwal Perayaan Ekaristi</a></li>
                        <li><a href="{{ route('public.warta') }}"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem; color: var(--color-accent);"></i> Lembar Warta Paroki (PDF)</a></li>
                        <li><a href="{{ route('public.arsitektur') }}"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem; color: var(--color-accent);"></i> 20 Simbol Arsitektur Joglo</a></li>
                        <li><a href="{{ route('public.sakramen') }}"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem; color: var(--color-accent);"></i> Persyaratan & Panduan Sakramen</a></li>
                        <li><a href="{{ route('public.lingkungan_stasi') }}"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem; color: var(--color-accent);"></i> 14 Lingkungan & 7 Stasi</a></li>
                    </ul>
                </div>

                <!-- Col 3: Contact & Sekretariat -->
                <div>
                    <h4 style="font-size: 1.15rem;">Sekretariat Paroki</h4>
                    <p style="font-size: 0.9rem; line-height: 1.7; color: #D1C5B6;">
                        <i class="fa-solid fa-location-dot" style="color: var(--color-accent); margin-right: 0.5rem;"></i> Jl. Letjen S. Parman No. 2, Wonosobo 56311<br>
                        <i class="fa-solid fa-phone" style="color: var(--color-accent); margin-right: 0.5rem;"></i> (0286) 321xxx<br>
                        <i class="fa-solid fa-envelope" style="color: var(--color-accent); margin-right: 0.5rem;"></i> sekretariat@parokiwonosobo.org<br>
                        <i class="fa-brands fa-whatsapp" style="color: #4ade80; margin-right: 0.5rem;"></i> 0812-3456-7890
                    </p>
                    <div style="margin-top: 1rem; font-size: 0.85rem; color: #A69787;">
                        Jam Layanan Sekretariat:<br>
                        Senin - Sabtu: 08.00 - 14.00 WIB<br>
                        Minggu: 08.00 - 12.00 WIB
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 1.25rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; font-size: 0.825rem; color: #A69787;">
                <div>
                    &copy; {{ date('Y') }} Paroki Santo Paulus Wonosobo - Keuskupan Purwokerto. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Responsive hamburger navigation handler
        const menuBtn = document.getElementById('mobileMenuBtn');
        const mainNav = document.getElementById('mainNav');
        const menuIcon = menuBtn ? menuBtn.querySelector('i') : null;

        function toggleMobileMenu() {
            const isOpen = mainNav.classList.toggle('mobile-active');
            menuBtn.classList.toggle('active', isOpen);
            menuBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (menuIcon) {
                if (isOpen) {
                    menuIcon.classList.remove('fa-bars');
                    menuIcon.classList.add('fa-xmark');
                } else {
                    menuIcon.classList.remove('fa-xmark');
                    menuIcon.classList.add('fa-bars');
                }
            }
        }

        if (menuBtn && mainNav) {
            menuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        // Close mobile nav when clicking outside
        document.addEventListener('click', function(e) {
            if (mainNav && mainNav.classList.contains('mobile-active') && !mainNav.contains(e.target) && !menuBtn.contains(e.target)) {
                mainNav.classList.remove('mobile-active');
                menuBtn.classList.remove('active');
                menuBtn.setAttribute('aria-expanded', 'false');
                if (menuIcon) {
                    menuIcon.classList.remove('fa-xmark');
                    menuIcon.classList.add('fa-bars');
                }
            }
        });

        // Dropdown toggle handler
        const quickDropdown = document.getElementById('quickAccessDropdown');
        const quickBtn = document.getElementById('quickAccessBtn');

        if (quickBtn && quickDropdown) {
            quickBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                quickDropdown.classList.toggle('is-open');
                const isOpen = quickDropdown.classList.contains('is-open');
                quickBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });

            document.addEventListener('click', function(e) {
                if (!quickDropdown.contains(e.target)) {
                    quickDropdown.classList.remove('is-open');
                    quickBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 991) {
                if (mainNav) {
                    mainNav.classList.remove('mobile-active');
                }
                if (menuBtn) {
                    menuBtn.classList.remove('active');
                    menuBtn.setAttribute('aria-expanded', 'false');
                }
                if (menuIcon) {
                    menuIcon.classList.remove('fa-xmark');
                    menuIcon.classList.add('fa-bars');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

