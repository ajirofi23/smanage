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

    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px 12px;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }

    .table-card h5 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #667eea;
    }

    .table {
        margin: 0;
    }

    .table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .table thead th {
        border: none;
        font-weight: 500;
        padding: 12px;
        vertical-align: middle;
    }

    .table tbody td {
        vertical-align: middle;
        padding: 12px;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.875rem;
        margin: 0 2px;
        transition: all 0.2s;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #000;
        border: none;
    }

    .btn-edit:hover {
        background-color: #ffb300;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-delete:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .btn-view {
        background-color: #17a2b8;
        color: white;
        border: none;
    }

    .btn-view:hover {
        background-color: #138496;
        transform: translateY(-2px);
    }

    .image-preview {
        max-width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .image-preview:hover {
        transform: scale(1.1);
    }

    /* File Upload Custom */
    .custom-file-upload {
        border: 2px dashed #ddd;
        border-radius: 6px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .custom-file-upload:hover {
        border-color: #667eea;
        background-color: #f8f9fa;
    }

    .custom-file-upload i {
        font-size: 2rem;
        color: #667eea;
        margin-bottom: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .btn-action {
            padding: 4px 8px;
            font-size: 0.75rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h2>
            <i class="fa-solid fa-shield-halved"></i>
            Safety Riding
        </h2>
        <p>Pengelolaan Data Laporan Safety Riding</p>
    </div>

    <div class="form-card">
        <h5><i class="fa-solid fa-plus-circle me-2"></i>Form Input Safety Riding</h5>
        <form id="patrolForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="edit_id" name="id">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">
                        <i class="fa-solid fa-calendar me-1"></i>Tanggal
                    </label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jam" class="form-label">
                        <i class="fa-solid fa-clock me-1"></i>Jam
                    </label>
                    <input type="time" class="form-control" id="jam" name="jam" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="lokasi" class="form-label">
                        <i class="fa-solid fa-location-dot me-1"></i>Lokasi
                    </label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan lokasi temuan" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="koordinat" class="form-label">
                        <i class="fa-solid fa-map-marker-alt me-1"></i>Koordinat
                    </label>
                    <input type="text" class="form-control" id="koordinat" name="koordinat" placeholder="Contoh: -6.200000, 106.816666" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="kronologi" class="form-label">
                    <i class="fa-solid fa-file-lines me-1"></i>Kronologi / Deskripsi Temuan
                </label>
                <textarea class="form-control" id="kronologi" name="kronologi" rows="4" placeholder="Jelaskan temuan patroli secara detail..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">
                    <i class="fa-solid fa-circle-info me-1"></i>Status
                </label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Open" selected>Open</option>
                    <option value="Close">Close</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fa-solid fa-camera me-1"></i>Bukti Foto / Video
                </label>
                <div class="custom-file-upload" onclick="document.getElementById('bukti').click()">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p class="mb-0">Klik untuk upload foto atau video</p>
                    <small class="text-muted">Format: JPG, PNG, MP4 (Max: 10MB)</small>
                </div>
                <input type="file" class="form-control d-none" id="bukti" name="bukti" accept="image/*,video/*">
                <div id="filePreview" class="mt-2"></div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-2"></i>Simpan Data
                </button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                    <i class="fa-solid fa-rotate-left me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>

    <div class="table-card">
        <h5><i class="fa-solid fa-table me-2"></i>Data Safety Riding
        </h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Tanggal</th>
                        <th width="8%">Jam</th>
                        <th width="15%">Lokasi</th>
                        <th width="10%">Status</th>
                        <th width="22%">Kronologi</th>
                        <th width="10%">Bukti</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
                    <tr>
                        <td>1</td>
                        <td>2025-10-06</td>
                        <td>14:30</td>
                        <td>Area Produksi A</td>
                        <td><span class="badge bg-danger">Open</span></td>
                        <td>Ditemukan ceceran oli di lantai...</td>
                        <td>
                            <img src="https://via.placeholder.com/80x60" class="image-preview" alt="Bukti" onclick="viewImage(this.src)">
                        </td>
                        <td>
                            <button class="btn btn-action btn-view" onclick="viewDetail(1)" title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-action btn-edit" onclick="editData(1)" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn btn-action btn-delete" onclick="deleteData(1)" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2025-10-05</td>
                        <td>09:15</td>
                        <td>Warehouse B</td>
                        <td><span class="badge bg-success">Close</span></td>
                        <td>Kotak P3K tidak lengkap...</td>
                        <td>
                            <img src="https://via.placeholder.com/80x60" class="image-preview" alt="Bukti" onclick="viewImage(this.src)">
                        </td>
                        <td>
                            <button class="btn btn-action btn-view" onclick="viewDetail(2)" title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-action btn-edit" onclick="editData(2)" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn btn-action btn-delete" onclick="deleteData(2)" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview file upload
    document.getElementById('bukti').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('filePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (file.type.startsWith('image/')) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px;">`;
                } else if (file.type.startsWith('video/')) {
                    preview.innerHTML = `<video controls class="img-thumbnail" style="max-width: 300px;">
                        <source src="${e.target.result}" type="${file.type}">
                    </video>`;
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Submit form
    document.getElementById('patrolForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Simulasi AJAX submit (ganti dengan endpoint Laravel Anda)
        console.log('Data yang akan dikirim:', Object.fromEntries(formData));
        
        alert('Data patroli berhasil disimpan!');
        resetForm();
        
        // TODO: Implementasi AJAX ke backend Laravel
        // fetch('/api/safety-patrol', {
        //     method: 'POST',
        //     body: formData
        // }).then(response => response.json())
        // .then(data => {
        //     alert('Data berhasil disimpan!');
        //     resetForm();
        //     loadData();
        // });
    });

    // Reset form
    function resetForm() {
        document.getElementById('patrolForm').reset();
        document.getElementById('edit_id').value = '';
        document.getElementById('status').value = 'Open'; // Kembalikan status ke default
        document.getElementById('filePreview').innerHTML = '';
    }

    // Edit data
    function editData(id) {
        // TODO: Load data dari backend dan isi form
        alert('Edit data ID: ' + id);
        
        // Contoh populate form
        document.getElementById('edit_id').value = id;
        document.getElementById('tanggal').value = '2025-10-06';
        document.getElementById('jam').value = '14:30';
        document.getElementById('lokasi').value = 'Area Produksi A';
        document.getElementById('koordinat').value = '-6.200000, 106.816666';
        document.getElementById('kronologi').value = 'Ditemukan ceceran oli di lantai...';
        document.getElementById('status').value = 'Open'; // Sesuaikan dengan data yang di-edit
        
        // Scroll ke form
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Delete data
    function deleteData(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // TODO: Kirim request delete ke backend
            alert('Data ID ' + id + ' berhasil dihapus!');
            
            // fetch('/api/safety-patrol/' + id, {
            //     method: 'DELETE'
            // }).then(response => {
            //     alert('Data berhasil dihapus!');
            //     loadData();
            // });
        }
    }

    // View detail
    function viewDetail(id) {
        alert('Lihat detail data ID: ' + id);
        // TODO: Buka modal atau redirect ke halaman detail
    }

    // View image in modal
    function viewImage(src) {
        // TODO: Implementasi modal untuk view image
        window.open(src, '_blank');
    }

    // Load data from backend
    function loadData() {
        // TODO: Load data dari backend Laravel
        // fetch('/api/safety-patrol')
        //     .then(response => response.json())
        //     .then(data => {
        //         // Render data ke tabel
        //     });
    }
</script>
@endpush