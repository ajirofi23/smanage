{{-- File: resources/views/incident/hyari-hatto.blade.php --}}

@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    .main-content main {
        padding: 20px !important;
        background-color: var(--bg-color);
        min-height: calc(100vh - 72px);
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .page-header h2 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    /* Form Card */
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border-color);
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        color: var(--text-color);
    }

    .form-card h5 {
        color: var(--text-color-strong);
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-blue);
    }

    .form-label {
        font-weight: 500;
        color: var(--text-color);
        margin-bottom: 8px;
    }

    .form-check-input:checked {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #764ba2 100%);
        border: none;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .btn-primary:disabled {
        background: #ced4da; /* Warna abu-abu saat nonaktif */
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .commitment-list {
        list-style-position: inside;
        padding-left: 0;
        color: var(--text-color);
    }

    .commitment-list li {
        margin-bottom: 12px;
        line-height: 1.6;
    }

</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h2>
            <i class="fa-solid fa-shield-halved"></i>
            Pernyataan Komitmen K3
        </h2>
        <p>Formulir Pernyataan Komitmen Keselamatan dan Kesehatan Kerja</p>
    </div>

    <div class="form-card">
        <h5><i class="fa-solid fa-file-signature me-2"></i>Komitmen K3</h5>
        <form id="commitmentForm">
            @csrf
            <p>Sebagai bentuk kepedulian terhadap Keselamatan dan Kesehatan Kerja (K3), saya menyatakan komitmen sebagai berikut:</p>
            
            <ol class="commitment-list">
                <li>Saya berkomitmen untuk selalu menggunakan APD (Alat Pelindung Diri) sesuai SOP yang berlaku.</li>
                <li>Saya akan melaporkan setiap ada potensi bahaya atau kecelakaan kerja kepada atasan/PIC.</li>
                <li>Saya berkomitmen mengikuti prosedur kerja dan IK yang aman.</li>
                <li>Saya berjanji tidak melakukan tindakan yang dapat membahayakan diri sendiri maupun para member.</li>
                <li>Saya bersedia dan siap mengikuti kegiatan pelatihan dan sosialisasi K3 yang diadakan oleh perusahaan.</li>
                <li>Saya sangat mendukung kerja aman, nyaman, sehat, dan peduli terhadap lingkungan kerja.</li>
                <li>Saya akan menerapkan 5R setiap hari sesudah maupun sebelum bekerja.</li>
            </ol>
            
            <hr class="my-4">
            
            <p class="fw-bold fst-italic">
                "Dengan ini saya menyatakan setuju untuk melaksanakan komitmen K3 sebagaimana tercantum dalam undang-undang perusahaan dan saya bersedia menerima konsekuensi jika saya melanggarnya."
            </p>

            <div class="form-check mb-3 mt-4">
                <input class="form-check-input" type="checkbox" value="1" id="agreementCheck" name="agreement" required>
                <label class="form-check-label" for="agreementCheck">
                    <strong>Saya telah membaca dan menyetujui semua poin komitmen di atas.</strong>
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                <i class="fa-solid fa-hourglass-start me-2"></i>Harap Baca (30s)
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitButton = document.getElementById('submitBtn');
        let countdown = 30; // Durasi timer dalam detik

        // Fungsi yang akan dijalankan setiap detik
        const timerInterval = setInterval(function() {
            countdown--;
            if (countdown > 0) {
                // Update teks tombol selama hitung mundur
                submitButton.innerHTML = `<i class="fa-solid fa-hourglass-half me-2"></i>Harap Baca (${countdown}s)`;
            } else {
                // Hentikan interval saat hitungan selesai
                clearInterval(timerInterval);
                // Aktifkan tombol
                submitButton.disabled = false;
                // Ubah teks tombol ke keadaan normal
                submitButton.innerHTML = `<i class="fa-solid fa-check-circle me-2"></i>Kirim Pernyataan`;
            }
        }, 1000); // Interval 1000ms = 1 detik
    });

    // Submit commitment form
    document.getElementById('commitmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!document.getElementById('agreementCheck').checked) {
            alert('Anda harus menyetujui pernyataan komitmen untuk melanjutkan.');
            return;
        }

        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        
        console.log('Komitmen disetujui. Mengirim data...');
        
        // --- Simulasi AJAX submit ---
        alert('Terima kasih! Pernyataan komitmen K3 Anda telah berhasil disimpan.');
        
        document.getElementById('agreementCheck').disabled = true;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fa-solid fa-check-circle me-2"></i>Tersimpan';
        // --- Akhir Simulasi ---

        /* // --- CONTOH Implementasi AJAX ke backend Laravel ---
        fetch('/path/to/your/endpoint', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Terima kasih! Pernyataan komitmen K3 Anda telah berhasil disimpan.');
                document.getElementById('agreementCheck').disabled = true;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-check-circle me-2"></i>Tersimpan';
            } else {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada jaringan. Silakan coba lagi.');
        });
        */
    });
</script>
@endpush