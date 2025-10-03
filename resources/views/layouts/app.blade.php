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
            width: 250px;
            background-color: #343a40;
            padding-top: 1rem;
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            font-size: 1rem;
            padding: 0.75rem 1.25rem;
        }
        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: #495057;
        }
        .sidebar .nav-link.active {
            color: #ffffff;
            font-weight: bold;
        }
        .sidebar .nav-link .bi {
            margin-right: 10px;
        }
        .sidebar .sub-menu {
            padding-left: 2.5rem; /* Indent sub-menu items */
            background-color: #2c3136;
        }

        /* Backdrop for mobile when sidebar open */
        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1040; /* below sidebar */
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
            margin-left: 250px;
            padding: 0;
            transition: all 0.3s;
        }

        /* Responsive: sembunyikan sidebar di mobile dan atur overlay */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%); /* sembunyi */
            }
            .sidebar.show {
                transform: translateX(0); /* tampil */
            }
            .main-content {
                margin-left: 0;
            }
            /* ketika sidebar terbuka, hentikan scroll body */
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
        <div class="p-3 mb-3 position-relative">
            <h4 class="text-center">SHE Management</h4>
            <!-- Tombol close hanya terlihat di mobile -->
            <button class="btn btn-sm btn-outline-light position-absolute top-0 end-0 m-2 d-lg-none" id="sidebarClose" aria-label="Tutup sidebar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            
            <hr class="text-secondary">

            <li class="nav-item">
                <a class="nav-link" href="#incident-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="incident-submenu">
                    <i class="bi bi-exclamation-triangle-fill"></i> Managemen Insident
                </a>
                <ul class="collapse list-unstyled sub-menu" id="incident-submenu">
                    <li><a class="nav-link" href="#">1. Hyari Hatto</a></li>
                    <li><a class="nav-link" href="#">2. Pelaporan Insiden</a></li>
                    <li><a class="nav-link" href="#">3. Pelaporan Accident</a></li>
                    <li><a class="nav-link" href="#">4. Komitmen K3</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#audit-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="audit-submenu">
                    <i class="bi bi-clipboard2-check-fill"></i> Managemen Audit
                </a>
                <ul class="collapse list-unstyled sub-menu" id="audit-submenu">
                    <li><a class="nav-link" href="#">1. Safety Patrol</a></li>
                    <li><a class="nav-link" href="#">2. Safety Riding</a></li>
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
                        <li><a class="dropdown-item" href="../logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container-fluid p-4">
            {{-- Konten dinamis akan dimuat di sini --}}
            @yield('content') 

            
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
            // kalau link punya data-bs-toggle="collapse" → jangan tutup
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