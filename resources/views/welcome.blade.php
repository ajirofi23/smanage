<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AICC - Safety, Health & Environment</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* CSS Reset & Pengaturan Font Dasar */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f9;
            color: #333;
            line-height: 1.6;
        }

        /* Navigasi Header */
        .navbar {
            background-color: #ffffff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
        }
        .navbar .logo .highlight {
            background-color: #e65100;
            color: #ffffff;
            padding: 0 8px;
            border-radius: 5px;
        }
        .navbar .nav-links a {
            color: #333;
            text-decoration: none;
            margin-left: 1.5rem;
            font-weight: 600;
            transition: color 0.3s;
        }
        .navbar .nav-links a:hover {
            color: #e65100;
        }

        .login-button {
            background-color: #364e68;
            color: #ffffff !important; /* !important untuk override warna link */
            padding: 0.5rem 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: #1f2937;
            color: #ffffff !important;
        }

        /* Hero Section (Bagian Utama Paling Atas) */
        .hero {
            background: linear-gradient(rgba(44, 62, 80, 0.7), rgba(44, 62, 80, 0.7)), url('https://images.unsplash.com/photo-1554189097-97a57a22c454?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            color: #ffffff;
            text-align: center;
            padding: 6rem 1rem;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem auto;
        }
        .hero .cta-button {
            background-color: #e65100;
            color: #ffffff;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .hero .cta-button:hover {
            background-color: #c54500;
        }

        /* Container untuk Konten */
        .container {
            padding: 4rem 2rem;
            max-width: 1100px;
            margin: auto;
        }

        /* Section: Komitmen Kami */
        .commitment-section {
            text-align: center;
        }
        .section-title {
            font-size: 2.2rem;
            margin-bottom: 1rem;
            color: #1f2937;
        }
        .section-subtitle {
            font-size: 1.1rem;
            color: #555;
            max-width: 700px;
            margin: 0 auto 3rem auto;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .feature-item {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            text-align: center;
        }
        .feature-item .icon {
            font-size: 2.5rem;
            color: #364e68;
            margin-bottom: 1rem;
        }
        .feature-item h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        /* Section: Statistik Kunci */
        .stats-section {
            background-color: #364e68;
            color: #ffffff;
            text-align: center;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }
        .stat-item {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 8px;
        }
        .stat-item .number {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .stat-item .label {
            font-size: 1rem;
        }
        
        /* Footer */
        .footer {
            background-color: #1f2937;
            color: #f4f7f9;
            text-align: center;
            padding: 2rem;
        }

        /* Responsif untuk Mobile */
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .features-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .navbar { flex-direction: column; gap: 1rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo"><span class="highlight">AICC</span> SHE</div>
        <div class="nav-links">
            <a href="#commitment">Komitmen</a>
            <a href="#stats">Statistik</a>
            <a href="#">Kontak</a>
            @guest
        <!-- Kalau belum login -->
        <a href="{{ url('/login') }}" class="login-button">Login</a>
    @endguest

    @auth
    <a href="{{ url('/logout') }}" class="login-button">Logout</a>
@endauth
</div>
    </nav>

    <header class="hero">
        <h1>Membangun Lingkungan Kerja Aman dan Sehat</h1>
        <p>Di AICC, kami percaya bahwa keselamatan adalah prioritas utama. Program Safety, Health & Environment (SHE) kami adalah wujud komitmen nyata untuk melindungi aset terpenting kami: Anda.</p>
        <a href="#commitment" class="cta-button">Pelajari Lebih Lanjut</a>
    </header>
    
    <main>
        <section id="commitment" class="container commitment-section">
            <h2 class="section-title">Komitmen Kami pada K3</h2>
            <p class="section-subtitle">Kami mendedikasikan diri untuk menciptakan budaya kerja di mana setiap individu merasa aman, sehat, dan dihargai. Tiga pilar utama kami adalah:</p>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h3>Keselamatan (Safety)</h3>
                    <p>Mencegah kecelakaan kerja melalui pelatihan, patroli keselamatan rutin, dan implementasi prosedur yang ketat.</p>
                </div>
                <div class="feature-item">
                    <div class="icon"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h3>Kesehatan (Health)</h3>
                    <p>Memastikan kesejahteraan fisik dan mental karyawan dengan lingkungan yang ergonomis dan program kesehatan.</p>
                </div>
                <div class="feature-item">
                    <div class="icon"><i class="fa-solid fa-leaf"></i></div>
                    <h3>Lingkungan (Environment)</h3>
                    <p>Bertanggung jawab terhadap dampak lingkungan dengan praktik kerja yang berkelanjutan dan ramah lingkungan.</p>
                </div>
            </div>
        </section>

        <section id="stats" class="stats-section">
            <div class="container">
                <h2 class="section-title" style="color: #ffffff;">Pencapaian Kami Sekilas</h2>
                <p class="section-subtitle" style="color: #e0e0e0;">Data adalah bukti komitmen kami. Berikut adalah ringkasan performa SHE kami secara real-time.</p>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="number">2000</div>
                        <div class="label">Total Manpower</div>
                    </div>
                    <div class="stat-item">
                        <div class="number">100%</div>
                        <div class="label">Zero Work Accident</div>
                    </div>
                    <div class="stat-item">
                        <div class="number">100%</div>
                        <div class="label">Zero Fire Accident</div>
                    </div>
                    <div class="stat-item">
                        <div class="number">100%</div>
                        <div class="label">Safety Finding</div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; <span id="current-year"></span> AICC Safety, Health & Environment. All Rights Reserved.</p>
    </footer>

    <script>
        // Script untuk menampilkan tahun sekarang di footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
</body>
</html>