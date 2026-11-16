<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Paroki Santo Paulus Wonosobo') - Keuskupan Purwokerto</title>
    <meta name="description" content="@yield('meta_description', 'Website Resmi Paroki Santo Paulus Wonosobo - Gereja Katolik berarsitektur Joglo Pangrawit Ceblokan dan spiritualitas Goa Garba di Wonosobo.')">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-paroki.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/paroki-theme.css') }}">
    <!-- Inline helpers for mobile navigation & icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')
</head>
<body>
    <!-- Top Bar -->
    <div class="paroki-topbar">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
            <div style="display: flex; gap: 1.25rem; align-items: center;">
                <span><i class="fa-solid fa-phone" style="margin-right: 0.35rem; color: var(--color-accent);"></i> (0286) 321xxx</span>
                <span><i class="fa-brands fa-whatsapp" style="margin-right: 0.35rem; color: #4ade80;"></i> 0812-3456-7890</span>
                <span class="d-none-sm"><i class="fa-solid fa-location-dot" style="margin-right: 0.35rem; color: var(--color-accent);"></i> Jl. Letjen S. Parman No. 2, Wonosobo</span>
            </div>
            <div>
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
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; padding-top: 0.75rem; padding-bottom: 0.75rem;">
            <!-- Brand / Logo -->
            <a href="{{ route('public.index') }}" style="display: flex; align-items: center; gap: 0.65rem; text-decoration: none;">
                <img src="{{ asset('images/logo-paroki.png') }}" alt="Logo Paroki Santo Paulus Wonosobo" class="rounded-full object-cover" style="height: 44px; width: 44px; padding: 0; flex-shrink: 0;">
                <img src="{{ asset('images/logo-omk.png') }}" alt="Logo OMK Wonosobo" style="height: 44px; width: 44px; object-fit: contain; flex-shrink: 0;">
                <div style="margin-left: 0.15rem;">
                    <div style="font-family: var(--font-serif); font-size: 1.25rem; font-weight: 700; color: var(--color-primary); line-height: 1.1;">PAROKI SANTO PAULUS</div>
                    <div style="font-size: 0.75rem; letter-spacing: 0.12em; color: var(--color-secondary); font-weight: 600;">WONOSOBO</div>
                </div>
            </a>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobileMenuBtn" aria-label="Buka Menu" style="display: none; background: none; border: 1px solid var(--color-border); padding: 0.5rem 0.75rem; border-radius: var(--radius-md); font-size: 1.25rem; color: var(--color-primary); cursor: pointer;">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Desktop Nav Links -->
            <nav id="mainNav" style="display: flex; gap: 0.25rem; align-items: center; flex-wrap: wrap;">
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

        function checkMobile() {
            if (window.innerWidth <= 991) {
                menuBtn.style.display = 'block';
                mainNav.style.display = 'none';
                mainNav.style.flexDirection = 'column';
                mainNav.style.width = '100%';
                mainNav.style.paddingTop = '1rem';
            } else {
                menuBtn.style.display = 'none';
                mainNav.style.display = 'flex';
                mainNav.style.flexDirection = 'row';
                mainNav.style.width = 'auto';
                mainNav.style.paddingTop = '0';
            }
        }

        menuBtn.addEventListener('click', function() {
            if (mainNav.style.display === 'none') {
                mainNav.style.display = 'flex';
            } else {
                mainNav.style.display = 'none';
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

        window.addEventListener('resize', checkMobile);
        checkMobile();
    </script>
    @stack('scripts')
</body>
</html>

