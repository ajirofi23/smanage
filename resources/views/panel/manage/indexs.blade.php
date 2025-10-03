<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AICC SHE Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* CSS Reset dan Pengaturan Dasar */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: Arial, sans-serif;
            background-color: #dbe2ef;
        }

        /* Kontainer utama untuk seluruh dashboard */
        .dashboard-container {
            max-width: 100%;
            height: 100vh;
            padding: 15px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        /* Header Dashboard */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 0 5px;
            flex-shrink: 0;
        }

        .header-date {
            font-size: 1em;
            color: #333;
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 8px 12px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .header-date i {
            margin-right: 10px;
        }

        .header-title {
            font-size: 2em;
            font-weight: bold;
            color: #1f2937;
        }

        .header-title .highlight {
            background-color: #e65100;
            color: #ffffff;
            padding: 2px 10px;
            border-radius: 5px;
            margin-right: 5px;
        }
        
        /* Grid untuk menampung semua panel/kartu */
        .dashboard-grid {
            flex-grow: 1;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(5, 1fr); 
            gap: 12px;
            height: 100%;
        }

        /* Styling dasar untuk setiap panel/kartu */
        .card {
            background-color: #364e68;
            color: #ffffff;
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #4f6a89;
            border-top: 2px solid #607d8b;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* << DIUBAH: Konten dimulai dari atas */
            font-weight: 500;
            font-size: 1em;
        }
        
        .card .title {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* PERUBAHAN UTAMA ADA DI SINI */
        .card .content {
            flex-grow: 1; /* Membuat div ini mengisi sisa ruang vertikal */
            display: flex;
            justify-content: center; /* Memusatkan konten (100%) secara horizontal */
            align-items: center;   /* Memusatkan konten (100%) secara vertikal */
            font-size: 3.5em; /* Font dibesarkan agar lebih menonjol di tengah */
            font-weight: bold;
        }
        
        /* Konten untuk manpower agar tetap di kanan bawah */
        #manpower .content {
            justify-content: flex-end; /* Tetap di kanan */
            align-items: flex-end;   /* Tetap di bawah */
            font-size: 2.5em;
        }

        /* Penempatan setiap kartu secara presisi di dalam grid */
        #manpower         { grid-area: 1 / 1 / 2 / 5; }
        #zero-work        { grid-area: 2 / 1 / 4 / 2; }
        #zero-fire        { grid-area: 2 / 2 / 4 / 3; }
        #safety-patrol    { grid-area: 2 / 3 / 4 / 5; }
        #zero-forklift    { grid-area: 4 / 1 / 6 / 2; }
        #zero-traffic     { grid-area: 4 / 2 / 6 / 3; }
        #komitmen-k3      { display: none; }
        #hiyari-hatto     { display: none; }
        #safety-riding    { grid-area: 4 / 3 / 6 / 5; }

        @media (max-width: 768px) {
            html, body { overflow: auto; }
            .dashboard-container { height: auto; }
            .dashboard-grid {
                grid-template-columns: 1fr;
                grid-template-rows: auto;
                height: auto;
            }
            #manpower, #zero-work, #zero-fire, #safety-patrol, #zero-forklift,
            #zero-traffic, #komitmen-k3, #hiyari-hatto, #safety-riding {
                grid-area: auto;
                display: flex;
                min-height: 120px;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-date">
                <i class="fa-solid fa-calendar-days"></i>
                <span id="current-date"></span>
            </div>
            <div class="header-title">
                <span class="highlight">AICC</span>SHE
            </div>
        </header>
        
        <main class="dashboard-grid">
            <div class="card" id="manpower">
                <div class="title"><i class="fa-solid fa-users"></i><span>Total Manpower</span></div>
                <div class="content">2000</div>
            </div>

            <div class="card" id="zero-work">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Work Accident</span></div>
                <div class="content">100%</div>
            </div>
            
            <div class="card" id="zero-fire">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Fire Accident</span></div>
                <div class="content">100%</div>
            </div>
            
            <div class="card" id="safety-patrol">
                <div class="title"><i class="fa-solid fa-clipboard-list"></i><span>Safety Patrol Finding</span></div>
                <div class="content">100%</div>
            </div>
            
            <div class="card" id="zero-forklift">
                 <div class="title"><i class="fa-solid fa-check"></i><span>Zero Forklift</span></div>
                 <div class="content">100%</div>
            </div>

            <div class="card" id="zero-traffic">
                 <div class="title"><i class="fa-solid fa-check"></i><span>Zero Traffic Accident</span></div>
                 <div class="content">100%</div>
            </div>
            
            <div class="card" id="komitmen-k3">
                <div class="title"><i class="fa-solid fa-shield-halved"></i><span>Komitmen K3</span></div>
                <div class="content">100%</div>
            </div>
            
            <div class="card" id="hiyari-hatto">
                <div class="title"><i class="fa-solid fa-hourglass-half"></i><span>Hiyari Hatto</span></div>
                <div class="content">100%</div>
            </div>
            
            <div class="card" id="safety-riding">
                 <div class="title"><i class="fa-solid fa-motorcycle"></i><span>Safety Riding Finding</span></div>
                 <div class="content">100%</div>
            </div>
        </main>
    </div>

    <script>
        const dateElement = document.getElementById('current-date');
        const today = new Date();
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        dateElement.textContent = today.toLocaleDateString('en-US', options);
    </script>

</body>
</html>