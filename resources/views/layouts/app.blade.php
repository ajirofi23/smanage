<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHE Management Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            background-color: #f8f9fa;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            padding-top: 0;
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            position: relative;
        }
        
        .sidebar-header h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-header h4 i {
            color: #3b82f6;
            font-size: 1.5rem;
        }
        
        .sidebar .nav-link {
            color: #cbd5e1;
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
            color: #ffffff;
            background-color: rgba(59, 130, 246, 0.1);
            transform: translateX(3px);
        }
        
        .sidebar .nav-link.active {
            color: #ffffff;
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        
        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        
        .sidebar .nav-link .bi-chevron-down {
            margin-left: auto;
            transition: transform 0.2s ease;
            font-size: 0.8rem;
        }
        
        .sidebar .nav-link[aria-expanded="true"] .bi-chevron-down {
            transform: rotate(180deg);
        }
        
        .sidebar .sub-menu {
            padding-left: 0;
            background-color: transparent;
        }
        
        .sidebar .sub-menu .nav-link {
            padding-left: 3.25rem;
            font-size: 0.875rem;
            margin: 0.15rem 0.75rem;
            position: relative;
        }
        
        .sidebar .sub-menu .nav-link:before {
            content: "•";
            position: absolute;
            left: 2.5rem;
            color: #64748b;
        }
        
        .sidebar hr {
            margin: 0.75rem 1rem;
            opacity: 0.1;
            border-color: #fff;
        }

        /* Backdrop for mobile when sidebar open */
        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s;
        }
        
        .sidebar-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        /* Default tampil di desktop */
        .main-content {
            margin-left: 260px;
            padding: 0;
            transition: all 0.3s;
        }

        /* Responsive: sembunyikan sidebar di mobile dan atur overlay */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            body.sidebar-open {
                overflow: hidden;
            }
        }

        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }
        
        .navbar-brand-logo {
            font-weight: bold;
            color: #0d6efd;
        }
        
        .profile-dropdown img {
            width: 40px;
            height: 40px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar text-white" id="sidebarMenu" aria-hidden="false">
        <div class="sidebar-header">
            <h4>
                <i class="bi bi-shield-shaded"></i>
                SHE Management
            </h4>
            <!-- Tombol close hanya terlihat di mobile -->
            <button class="btn btn-sm btn-close btn-close-white position-absolute top-0 end-0 m-3 d-lg-none" id="sidebarClose" aria-label="Tutup sidebar"></button>
        </div>
        <ul class="nav flex-column py-3">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/panel/manage') }}">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <hr class="text-secondary">

            <li class="nav-item">
                <a class="nav-link" href="#incident-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="incident-submenu">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Managemen Insident</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled sub-menu" id="incident-submenu">
                    <li><a class="nav-link" href="{{ url('/panel/manage/hyari-hatto') }}"><i class="bi bi-eyeglasses"></i> Hyari Hatto</a></li>
                    <li><a class="nav-link" href="{{ url('/panel/manage/laporinsiden') }}"><i class="bi bi-file-earmark-text"></i> Pelaporan Insiden</a></li>
                    <li><a class="nav-link" href="{{ url('/panel/manage/laporaccident') }}"><i class="bi bi-clipboard-x"></i> Pelaporan Accident</a></li>
                    <li><a class="nav-link" href="{{ url('/panel/manage/komitmenk3') }}"><i class="bi bi-hand-thumbs-up"></i> Komitmen K3</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#audit-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="audit-submenu">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Managemen Audit</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled sub-menu" id="audit-submenu">
                    <li><a class="nav-link" href="{{ url('/panel/manage/safetypatrol') }}"><i class="bi bi-person-walking"></i> Safety Patrol</a></li>
                    <li><a class="nav-link" href="{{ url('/panel/manage/safetyriding') }}"><i class="bi bi-bicycle"></i> Safety Riding</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <!-- Backdrop (klik untuk menutup sidebar di mobile) -->
    <div id="sidebarBackdrop" class="sidebar-backdrop" tabindex="-1" aria-hidden="true"></div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light top-navbar sticky-top p-3">
            <div class="container-fluid">
                <!-- Tombol toggle sidebar muncul hanya di mobile -->
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Buka sidebar">
                    <i class="bi bi-list"></i>
                </button>

                <a class="navbar-brand-logo" href="#">
                    <i class="bi bi-shield-check"></i>
                    SHE Management
                </a>

                <div class="dropdown profile-dropdown ms-auto">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://i.pravatar.cc/40?img=3" alt="profile" class="rounded-circle me-2">
                        <strong>User Name</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i> Detail Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="container-fluid p-4">
            {{-- Konten dinamis akan dimuat di sini --}}
            @yield('content')
        </main>
    </div>

@stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById("sidebarMenu");
        const sidebarToggle = document.getElementById("sidebarToggle");
        const sidebarClose = document.getElementById("sidebarClose");
        const backdrop = document.getElementById("sidebarBackdrop");

        function showSidebar() {
            sidebar.classList.add('show');
            backdrop.classList.add('show');
            document.body.classList.add('sidebar-open');
            sidebarToggle.setAttribute('aria-expanded', 'true');
            backdrop.setAttribute('aria-hidden', 'false');
            sidebar.setAttribute('aria-hidden', 'false');
        }

        function hideSidebar() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
            document.body.classList.remove('sidebar-open');
            sidebarToggle.setAttribute('aria-expanded', 'false');
            backdrop.setAttribute('aria-hidden', 'true');
            sidebar.setAttribute('aria-hidden', 'true');
        }

        sidebarToggle.addEventListener('click', () => {
            if (sidebar.classList.contains('show')) hideSidebar();
            else showSidebar();
        });

        sidebarClose.addEventListener('click', hideSidebar);
        backdrop.addEventListener('click', hideSidebar);

        // Jika klik salah satu link di sidebar pada layar kecil, tutup sidebar
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    if (!link.hasAttribute('data-bs-toggle')) {
                        hideSidebar();
                    }
                }
            });
        });

        // Tutup dengan tombol ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                hideSidebar();
            }
        });

        // Pastikan overlay/kelas dibersihkan saat resize ke desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                backdrop.classList.remove('show');
                sidebar.classList.remove('show');
                document.body.classList.remove('sidebar-open');
                sidebarToggle.setAttribute('aria-expanded','false');
                backdrop.setAttribute('aria-hidden','true');
                sidebar.setAttribute('aria-hidden','false');
            }
        });
    </script>
</body>
</html>