{{-- File: resources/views/dashboard/she.blade.php --}}

@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    /* 1. Pengaturan Dasar Konten Utama */
    .main-content main {
        padding: 15px !important;
        background-color: #dbe2ef;
        height: calc(100vh - 72px);
        overflow: auto; /* Mengizinkan scroll jika perlu */
    }

    /* 2. Container Dashboard */
    .dashboard-container {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* 3. Header Dashboard */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-shrink: 0;
    }
    .header-date {
        display: flex; align-items: center;
        background-color: #fff; padding: 8px 15px; border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        font-size: 1em; color: #333;
    }
    .header-date i { margin-right: 10px; }
    .modern-dropdown {
        margin-left: 10px;
        padding: 6px 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        font-size: 0.9em;
        color: #333;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    .modern-dropdown:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.5);
    }
    .header-title {
        font-size: 2em; font-weight: bold; color: #1f2937;
    }
    .header-title .modern-dropdown {
        font-weight: normal;
        font-size: 0.9em;
    }
    .header-title .highlight {
        background-color: #e65100; color: #ffffff; padding: 2px 10px;
        border-radius: 5px; margin-right: 5px;
    }

    /* 4. Grid & Penataannya (BAGIAN UTAMA YANG DIUBAH TOTAL) */
    .dashboard-grid {
        flex-grow: 1;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* 1 baris untuk manpower, 6 baris untuk konten utama */
        grid-template-rows: min-content repeat(6, 1fr); 
        gap: 15px;
    }

    /* Penempatan Kartu di Grid (LAYOUT BARU) */
    #manpower { grid-area: 1 / 1 / 2 / 5; }

    /* Kolom 1 */
    #zero-work { grid-area: 2 / 1 / 4 / 2; }
    #zero-forklift { grid-area: 4 / 1 / 6 / 2; }
    #komitmen-k3 { grid-area: 6 / 1 / 8 / 2; }

    /* Kolom 2 */
    #zero-fire { grid-area: 2 / 2 / 4 / 3; }
    #zero-traffic { grid-area: 4 / 2 / 6 / 3; }
    #hiyari-hatto { grid-area: 6 / 2 / 8 / 3; }

    /* Kolom 3 (lebar) */
    #safety-patrol { grid-area: 2 / 3 / 5 / 5; } /* Mengisi 3 baris */
    #safety-riding { grid-area: 5 / 3 / 8 / 5; } /* Mengisi 3 baris */


    /* 5. Styling Kartu */
    .card.she-card {
        background-color: #364e68;
        color: #ffffff;
        border-radius: 12px;
        padding: 15px;
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        font-weight: 500;
        font-size: 1em;
    }
    .she-card .title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9em;
        font-weight: 600;
        opacity: 0.9;
    }
    .she-card .content {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2.8em; /* Sedikit disesuaikan agar seragam */
        font-weight: 700;
        line-height: 1;
    }
    #manpower .content {
        justify-content: flex-end;
        align-items: flex-end;
        padding-right: 10px;
    }
    
    /* 6. Aturan Responsive */
    @media (max-width: 992px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: auto;
        }
        .dashboard-grid .she-card { grid-area: unset !important; min-height: 180px; }
    }
    @media (max-width: 576px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .dashboard-grid .she-card { min-height: 150px; }
        .header-title { font-size: 1.5em; }
        .header-date { font-size: 0.9em; }
    }
</style>
@endpush

@section('content')
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-date">
                <i class="fa-solid fa-calendar-days"></i>
                <span id="current-date"></span>
                <select class="modern-dropdown" id="section-select">
                    <option value="all">All</option>
                    <option value="IT">IT</option>
                    <option value="HR">HR</option>
                    <option value="GA">GA</option>
                    <option value="SHE">SHE</option>
                </select>
                <select class="modern-dropdown" id="departemen-select">
                    <option value="all">All</option>
                    <option value="IT">IT</option>
                    <option value="HR/GA">HR/GA</option>
                    <option value="SHE">SHE</option>
                </select>
                <select class="modern-dropdown" id="quarter-select">
                    <option value="Q1">Q1</option>
                    <option value="Q2">Q2</option>
                </select>
                <select class="modern-dropdown" id="year-select">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
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

            {{-- Kolom 1 --}}
            <div class="card she-card" id="zero-work">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Work Accident</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="zero-forklift">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Forklift</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="komitmen-k3">
                <div class="title"><i class="fa-solid fa-award"></i><span>Komitmen K3</span></div>
                <div class="content">100%</div>
            </div>

            {{-- Kolom 2 --}}
            <div class="card she-card" id="zero-fire">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Fire Accident</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="zero-traffic">
                <div class="title"><i class="fa-solid fa-check"></i><span>Zero Traffic Accident</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="hiyari-hatto">
                <div class="title"><i class="fa-solid fa-lightbulb"></i><span>Hiyari Hatto</span></div>
                <div class="content">100%</div>
            </div>

            {{-- Kolom 3 --}}
            <div class="card she-card" id="safety-patrol">
                <div class="title"><i class="fa-solid fa-clipboard-list"></i><span>Safety Patrol Finding</span></div>
                <div class="content">100%</div>
            </div>
            <div class="card she-card" id="safety-riding">
                <div class="title"><i class="fa-solid fa-motorcycle"></i><span>Safety Riding Finding</span></div>
                <div class="content">100%</div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
<script>
    const dateElement = document.getElementById('current-date');
    const today = new Date();
    dateElement.textContent = today.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
</script>
@endpush

