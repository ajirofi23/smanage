<!DOCTYPE html>
<html lang="id" data-bs-theme="light"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SHE Management Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    @stack('styles')

    <style>
        /* === THEME VARIABLES === */
        :root, html[data-bs-theme="light"] {
            --body-bg: #f8f9fa;
            --navbar-bg: #ffffff;
            --navbar-border-color: #dee2e6;
            --sidebar-bg: #ffffff;
            --sidebar-border-color: #dee2e6;
            --sidebar-header-bg: transparent;
            --sidebar-header-color: #212529;
            --sidebar-header-border-color: #dee2e6;
            --sidebar-link-color: #495057;
            --sidebar-link-hover-color: #0d6efd;
            --sidebar-link-hover-bg: rgba(13, 110, 253, 0.08);
            --sidebar-link-active-color: #0d6efd;
            --sidebar-link-active-bg: rgba(13, 110, 253, 0.12);
            --sidebar-icon-color: #3b82f6;
            --sidebar-submenu-bullet-color: #6c757d;
            --sidebar-hr-color: #e9ecef;
            --text-color-strong: #212529;
            --card-bg: #ffffff;
            --card-border-color: #dee2e6;
            --text-color: #212529;
            --text-muted: #6c757d;
            --table-bg: #ffffff;
            --table-border-color: #dee2e6;
            --table-header-bg: #f8f9fa;
            --table-header-color: #212529;
        }

        html[data-bs-theme="dark"] {
            --body-bg: #111827;
            --navbar-bg: #1f2937;
            --navbar-border-color: #374151;
            --sidebar-bg: #1e293b;
            --sidebar-border-color: transparent;
            --sidebar-header-bg: rgba(255, 255, 255, 0.05);
            --sidebar-header-color: #ffffff;
            --sidebar-header-border-color: rgba(255, 255, 255, 0.1);
            --sidebar-link-color: #cbd5e1;
            --sidebar-link-hover-color: #ffffff;
            --sidebar-link-hover-bg: rgba(59, 130, 246, 0.1);
            --sidebar-link-active-color: #ffffff;
            --sidebar-link-active-bg: #3b82f6;
            --sidebar-icon-color: #3b82f6;
            --sidebar-submenu-bullet-color: #64748b;
            --sidebar-hr-color: rgba(255, 255, 255, 0.1);
            --text-color-strong: #ffffff;
            --card-bg: #1e293b;
            --card-border-color: rgba(255, 255, 255, 0.1);
            --text-color: #ffffff;
            --text-muted: #cbd5e1;
            --table-bg: #1e293b;
            --table-border-color: rgba(255, 255, 255, 0.1);
            --table-header-bg: #374151;
            --table-header-color: #ffffff;
        }

        /* === GLOBAL STYLES === */
        body {
            background-color: var(--body-bg);
            transition: background-color 0.3s ease;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border-color);
            padding-top: 0;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease, border-color 0.3s ease;
            z-index: 1050;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid var(--sidebar-header-border-color);
            background: var(--sidebar-header-bg);
            position: relative;
        }
        
        .sidebar-header h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--sidebar-header-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-header h4 i {
            color: var(--sidebar-icon-color);
            font-size: 1.5rem;
        }
        
        .sidebar .nav-link {
            color: var(--sidebar-link-color);
            font-size: 0.95rem;
            padding: 0.75rem 1.25rem;
            margin: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        
        .sidebar .nav-link:hover {
            color: var(--sidebar-link-hover-color);
            background-color: var(--sidebar-link-hover-bg);
            transform: translateX(3px);
        }
        
        .sidebar .nav-link.active {
            color: var(--sidebar-link-active-color);
            background: var(--sidebar-link-active-bg);
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        
        .sidebar .sub-menu .nav-link:before {
            content: "•";
            position: absolute;
            left: 2.5rem;
            color: var(--sidebar-submenu-bullet-color);
        }
        
        .sidebar hr {
            margin: 0.75rem 1rem;
            border-color: var(--sidebar-hr-color);
            opacity: 1;
        }
        
        .sidebar-header .btn-close {
            filter: var(--body-bg, #fff) == '#fff' ? invert(1) : none;
        }
        .sidebar .nav-link i { font-size: 1.1rem; width: 20px; text-align: center; }
        .sidebar .nav-link .bi-chevron-down { margin-left: auto; transition: transform 0.2s ease; font-size: 0.8rem; }
        .sidebar .nav-link[aria-expanded="true"] .bi-chevron-down { transform: rotate(180deg); }
        .sidebar .sub-menu { padding-left: 0; background-color: transparent; }
        .sidebar .sub-menu .nav-link { padding-left: 3.25rem; font-size: 0.875rem; margin: 0.15rem 0.75rem; position: relative; }

        /* Backdrop */
        .sidebar-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.45); z-index: 1040; opacity: 0; visibility: hidden; transition: opacity 0.3s ease-in-out, visibility 0.3s; }
        .sidebar-backdrop.show { opacity: 1; visibility: visible; }
        .main-content { margin-left: 260px; padding: 0; transition: all 0.3s; }
        .main-content main { background-color: var(--body-bg); min-height: calc(100vh - 72px); }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
            body.sidebar-open { overflow: hidden; }
        }

        /* Top Navbar */
        .top-navbar {
            background-color: var(--navbar-bg);
            border-bottom: 1px solid var(--navbar-border-color);
            transition: background-color 0.3s ease, border-color 0.3s ease;
            z-index: 1060;
        }
        .dropdown-menu {
            z-index: 1070;
        }
        .profile-dropdown a strong { color: var(--text-color-strong); }
        .navbar-brand-logo { font-weight: bold; color: #0d6efd; }
        .profile-dropdown img { width: 40px; height: 40px; }
        .theme-switcher .dropdown-item.active .bi { visibility: visible !important; }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebarMenu" aria-hidden="false">
        <div class="sidebar-header">
            <h4>
                <i class="bi bi-shield-shaded"></i>
                SHE Management
            </h4>
            <button class="btn-close position-absolute top-0 end-0 m-3 d-lg-none" id="sidebarClose" aria-label="Tutup sidebar"></button>
        </div>
        <ul class="nav flex-column py-3">
             <li class="nav-item">
                <a class="nav-link {{ request()->is('panel/manage') ? 'active' : '' }}" href="{{ url('/panel/manage') }}">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <hr>

            <li class="nav-item">
                <a class="nav-link" href="#incident-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="incident-submenu">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Managemen Insident</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled sub-menu" id="incident-submenu">
                    <li><a class="nav-link {{ request()->is('panel/manage/hyari-hatto') ? 'active' : '' }}" href="{{ url('/panel/manage/hyari-hatto') }}"><i class="bi bi-eyeglasses"></i> Hyari Hatto</a></li>
                    <li><a class="nav-link {{ request()->is('panel/manage/laporinsiden') ? 'active' : '' }}" href="{{ url('/panel/manage/laporinsiden') }}"><i class="bi bi-file-earmark-text"></i> Pelaporan Insiden</a></li>
                    <li><a class="nav-link {{ request()->is('panel/manage/laporaccident') ? 'active' : '' }}" href="{{ url('/panel/manage/laporaccident') }}"><i class="bi bi-clipboard-x"></i> Pelaporan Accident</a></li>
                    <li><a class="nav-link {{ request()->is('panel/manage/komitmenk3') ? 'active' : '' }}" href="{{ url('/panel/manage/komitmenk3') }}"><i class="bi bi-hand-thumbs-up"></i> Komitmen K3</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#audit-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="audit-submenu">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Managemen Audit</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled sub-menu" id="audit-submenu">
                    <li><a class="nav-link {{ request()->is('panel/manage/safetypatrol') ? 'active' : '' }}" href="{{ url('/panel/manage/safetypatrol') }}"><i class="bi bi-person-walking"></i> Safety Patrol</a></li>
                    <li><a class="nav-link {{ request()->is('panel/manage/safetyriding') ? 'active' : '' }}" href="{{ url('/panel/manage/safetyriding') }}"><i class="bi bi-bicycle"></i> Safety Riding</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#managehyari-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="audit-submenu">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Data Master Hyari Hatto</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled sub-menu" id="managehyari-submenu">
                    <li><a class="nav-link {{ request()->is('panel/manage/perilakutidakaman') ? 'active' : '' }}" href="{{ url('/panel/manage/perilakutidakaman') }}"><i class="bi bi-person-walking"></i> Perilaku Tidak Aman</a></li>
                    <li><a class="nav-link {{ request()->is('panel/manage/kondisitidakaman') ? 'active' : '' }}" href="{{ url('/panel/manage/kondisitidakaman') }}"><i class="bi bi-bicycle"></i> Kondisi Tidak Aman</a></li>
                    <li><a class="nav-link {{ request()->is('panel/manage/potensibahaya') ? 'active' : '' }}" href="{{ url('/panel/manage/potensibahaya') }}"><i class="bi bi-bicycle"></i> Potensi Bahaya </a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#management-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="management-submenu">
                    <i class="bi bi-people"></i>
                    <span>Management User</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled sub-menu" id="management-submenu">
                    <li><a class="nav-link {{ request()->is('panel/manage/add-user') ? 'active' : '' }}" href="{{ url('/panel/manage/add-user') }}"><i class="bi bi-person-plus"></i> Tambah User</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <div id="sidebarBackdrop" class="sidebar-backdrop" tabindex="-1" aria-hidden="true"></div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg top-navbar sticky-top p-3">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Buka sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <a class="navbar-brand-logo d-none d-lg-block" href="#">
                    <i class="bi bi-shield-check"></i> SHE Management
                </a>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown theme-switcher me-2">
                        <button class="btn btn-outline-secondary" type="button" id="theme-switcher-btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi" data-theme-icon-active></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="theme-switcher-btn">
                            <li>
                                <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="light">
                                    <i class="bi bi-sun-fill me-2"></i> Light <i class="bi bi-check-lg ms-auto invisible"></i>
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="dark">
                                    <i class="bi bi-moon-stars-fill me-2"></i> Dark <i class="bi bi-check-lg ms-auto invisible"></i>
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="auto">
                                    <i class="bi bi-circle-half me-2"></i> Auto <i class="bi bi-check-lg ms-auto invisible"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="dropdown profile-dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://i.pravatar.cc/40?img=3" alt="profile" class="rounded-circle me-2">
                            <strong>{{ Auth::user()->name }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person-circle me-2"></i> Detail Profile</a></li>                     <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <main>
            @yield('content')
        </main>
    </div>

@stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Sidebar Logic ---
            const sidebar = document.getElementById("sidebarMenu");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebarClose = document.getElementById("sidebarClose");
            const backdrop = document.getElementById("sidebarBackdrop");
            function showSidebar() { sidebar.classList.add('show'); backdrop.classList.add('show'); document.body.classList.add('sidebar-open'); }
            function hideSidebar() { sidebar.classList.remove('show'); backdrop.classList.remove('show'); document.body.classList.remove('sidebar-open'); }
            if(sidebarToggle) sidebarToggle.addEventListener('click', () => sidebar.classList.contains('show') ? hideSidebar() : showSidebar());
            if(sidebarClose) sidebarClose.addEventListener('click', hideSidebar);
            if(backdrop) backdrop.addEventListener('click', hideSidebar);
            
            // --- Auto-close sidebar on mobile after click ---
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.addEventListener('click', () => { if (window.innerWidth <= 991.98 && !link.hasAttribute('data-bs-toggle')) hideSidebar(); });
            });
            
            // --- Auto-open active submenu ---
            const activeSubLink = document.querySelector('.sub-menu .nav-link.active');
            if (activeSubLink) {
                const parentCollapse = activeSubLink.closest('.collapse');
                if (parentCollapse) new bootstrap.Collapse(parentCollapse, { toggle: true });
            }

            // --- THEME SWITCHER LOGIC ---
            const getStoredTheme = () => localStorage.getItem('theme');
            const setStoredTheme = theme => localStorage.setItem('theme', theme);

            const getTimeBasedTheme = () => {
                const now = new Date();
                const hour = now.getHours();
                return (hour >= 18 || hour < 6) ? 'dark' : 'light';
            };

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme();
                if (storedTheme) {
                    return storedTheme;
                }
                return getTimeBasedTheme();
            };

            const setTheme = theme => {
                if (theme === 'auto') {
                    document.documentElement.setAttribute('data-bs-theme', getTimeBasedTheme());
                } else {
                    document.documentElement.setAttribute('data-bs-theme', theme);
                }
            };

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector('#theme-switcher-btn');
                if (!themeSwitcher) return;
                
                const activeThemeIcon = document.querySelector('[data-theme-icon-active]');
                const activeDropdownItem = document.querySelector(`[data-bs-theme-value="${theme}"]`);
                const sunIcon = 'bi-sun-fill';
                const moonIcon = 'bi-moon-stars-fill';
                const autoIcon = 'bi-circle-half';

                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                    element.classList.remove('active');
                    element.querySelector('.bi-check-lg').classList.add('invisible');
                });

                activeDropdownItem.classList.add('active');
                activeDropdownItem.querySelector('.bi-check-lg').classList.remove('invisible');
                
                let iconClass;
                if (theme === 'light') iconClass = sunIcon;
                else if (theme === 'dark') iconClass = moonIcon;
                else iconClass = autoIcon;

                activeThemeIcon.className = `bi ${iconClass}`;
            };
            
            // Apply theme on load
            setTheme(getPreferredTheme());
            showActiveTheme(getPreferredTheme());

            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme();
                if (storedTheme !== 'light' && storedTheme !== 'dark') {
                    setTheme(getPreferredTheme());
                }
            });

            // Add click listeners to theme buttons
            document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const theme = toggle.getAttribute('data-bs-theme-value');
                    setStoredTheme(theme);
                    setTheme(theme);
                    showActiveTheme(theme, true);
                });
            });

            // Auto-switch theme every minute if 'auto' is selected
            setInterval(() => {
                const storedTheme = getStoredTheme();
                if (storedTheme === 'auto') {
                    setTheme('auto');
                }
            }, 60000);
        });
    </script>
</body>
</html>
