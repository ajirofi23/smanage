{{-- File: resources/views/dashboard/she.blade.php --}}

{{-- Menggunakan layout utama (dengan sidebar) dari layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Menambahkan CSS khusus untuk halaman ini saja --}}
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    /* Layout utama */
    .main-content main {
        padding: 15px !important;
        background-color: #dbe2ef;
        height: calc(100vh - 72px);
        overflow-y: auto;
    }

    /* Container dashboard */
    .dashboard-container {
        max-width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Header */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding: 0 5px;
        flex-shrink: 0;
    }
    .header-date {
        font-size: 1em; color: #333; display: flex; align-items: center;
        background-color: #fff; padding: 8px 12px; border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .header-date i { margin-right: 10px; }
    .header-title { font-size: 2em; font-weight: bold; color: #1f2937; }
    .header-title .highlight {
        background-color: #e65100; color: #ffffff; padding: 2px 10px;
        border-radius: 5px; margin-right: 5px;
    }

    /* Grid dashboard */
    .dashboard-grid {
        flex-grow: 1;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(5, 1fr); 
        gap: 12px;
    }

    /* Card */
    .card.she-card {
        background-color: #364e68; color: #ffffff; border-radius: 10px;
        padding: 15px; border: 1px solid #4f6a89; border-top: 2px solid #607d8b;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex;
        flex-direction: column; justify-content: flex-start;
        font-weight: 500; font-size: 1em;
    }
    .she-card .title { display: flex; align-items: center; gap: 8px; }
    .she-card .content {
        flex-grow: 1; display: flex; justify-content: center;
        align-items: center; font-size: 3.5em; font-weight: bold;
    }
    #manpower .content {
        justify-content: flex-end; align-items: flex-end; font-size: 2.5em;
    }

    /* Penempatan grid desktop */
    #manpower { grid-area: 1 / 1 / 2 / 5; }
    #zero-work { grid-area: 2 / 1 / 4 / 2; }
    #zero-fire { grid-area: 2 / 2 / 4 / 3; }
    #safety-patrol { grid-area: 2 / 3 / 4 / 5; }
    #zero-forklift { grid-area: 4 / 1 / 6 / 2; }
    #zero-traffic { grid-area: 4 / 2 / 6 / 3; }
    #komitmen-k3 { display: none; }
    #hiyari-hatto { display: none; }
    #safety-riding { grid-area: 4 / 3 / 6 / 5; }

    /* 🔹 Responsive Tablet (2 kolom) */
    @media (max-width: 992px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: auto;
        }
        .dashboard-grid .she-card {
            grid-area: unset !important;
        }
    }

    /* 🔹 Responsive Mobile (1 kolom) */
    @media (max-width: 576px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
            grid-template-rows: auto;
        }
        .dashboard-grid .she-card {
            grid-area: unset !important;
        }
    }
</style>
@endpush

{{-- Mendefinisikan bagian 'content' yang akan dimasukkan ke layout --}}
@section('content')
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
            <div class="card she-card" id="manpower">
                <div class="title"><i class="fa-solid fa-users"></i><span>Total Manpower</span></div>
                <div class="content">2000</div>
            </div>
            <div class="card she-card" id="zero-work">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Work Accident</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="zero-fire">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Fire Accident</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="safety-patrol">
                <div class="title"><i class="fa-solid fa-clipboard-list"></i><span>Safety Patrol Finding</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="zero-forklift">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Forklift</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="zero-traffic">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Traffic Accident</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="safety-riding">
                <div class="title"><i class="fa-solid fa-motorcycle"></i><span>Safety Riding Finding</span></div>
                <div class="content">100%</div>
            </div>
        </main>
    </div>
@endsection

{{-- Menambahkan JavaScript khusus untuk halaman ini --}}
@push('scripts')
<script>
    const dateElement = document.getElementById('current-date');
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    dateElement.textContent = today.toLocaleDateString('id-ID', options);
</script>
@endpush