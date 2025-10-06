{{-- File: resources/views/incident/hyari-hatto.blade.php --}}

@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    .main-content main {
        padding: 20px !important;
        background-color: #f8f9fa;
        min-height: calc(100vh - 72px);
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .form-card h5 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #667eea;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 8px;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
        transition: transform 0.2s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    }
    
    .commitment-list {
        list-style-position: inside;
        padding-left: 0;
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
                "Dengan ini saya menyatakan setuju untuk melaksanakan komitmen K3 sebagaimana tercantum dalam peraturan perusahaan dan saya bersedia menerima konsekuensi jika saya melanggarnya."
            </p>

            <div class="form-check mb-3 mt-4">
                <input class="form-check-input" type="checkbox" value="1" id="agreementCheck" name="agreement" required>
                <label class="form-check-label" for="agreementCheck">
                    <strong>Saya telah membaca dan menyetujui semua poin komitmen di atas.</strong>
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-check-circle me-2"></i>Kirim Pernyataan
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Submit commitment form
    document.getElementById('commitmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // This is a browser check, but the 'required' attribute on the checkbox is the primary validation
        if (!document.getElementById('agreementCheck').checked) {
            alert('Anda harus menyetujui pernyataan komitmen untuk melanjutkan.');
            return;
        }

        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        
        console.log('Komitmen disetujui. Mengirim data...');
        // You can use 'Object.fromEntries(formData)' to see the data being sent.
        
        // --- Simulasi AJAX submit ---
        // Ganti bagian ini dengan endpoint Laravel Anda yang sebenarnya
        alert('Terima kasih! Pernyataan komitmen K3 Anda telah berhasil disimpan.');
        
        // Menonaktifkan form setelah submit untuk mencegah pengiriman ganda
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