{{-- File: resources/views/incident/hyari-hatto.blade.php --}}

@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    /* Modern Blue and White Theme */
    :root {
        --primary-blue: #007bff;
        --primary-blue-darker: #0056b3;
    }

    .main-content main {
        padding: 20px !important;
        background-color: var(--bg-color);
        min-height: calc(100vh - 72px);
    }

    /* Updated Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .page-header h2 { margin: 0; font-weight: 600; display: flex; align-items: center; gap: 12px; }
    .page-header p { margin: 5px 0 0 0; opacity: 0.9; }

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
        border-bottom: 2px solid var(--primary-blue);
        padding-bottom: 10px;
    }

    .form-card h6 {
        color: var(--text-color-strong);
        font-weight: 600;
        margin-bottom: 15px;
    }

    .form-check-label {
        color: var(--text-color);
    }

    .form-label {
        font-weight: 500;
        color: var(--text-color);
        margin-bottom: 8px;
    }
    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px 12px;
        transition: all 0.3s;
        background-color: var(--input-bg);
        color: var(--text-color);
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Updated Button */
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #764ba2 100%);
        border: none;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
        transition: transform 0.2s;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .table-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border-color);
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        color: var(--text-color);
    }
    .table-card h5 {
        color: var(--text-color-strong);
        font-weight: 600;
        margin-bottom: 20px;
        border-bottom: 2px solid var(--primary-blue);
        padding-bottom: 10px;
    }

    /* Updated Table Header */
    .table {
        background-color: var(--table-bg);
        color: var(--text-color);
    }
    .table thead {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #764ba2 100%);
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
        background-color: var(--table-bg);
        color: var(--text-color);
    }
    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.05);
    }

    .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 0.875rem; margin: 0 2px; transition: all 0.2s; }
    .btn-edit { background-color: #ffc107; color: #000; border: none; }
    .btn-edit:hover { background-color: #ffb300; transform: translateY(-2px); }
    .btn-delete { background-color: #dc3545; color: white; border: none; }
    .btn-delete:hover { background-color: #c82333; transform: translateY(-2px); }
    .btn-view { background-color: #17a2b8; color: white; border: none; }
    .btn-view:hover { background-color: #138496; transform: translateY(-2px); }

    .image-preview { max-width: 80px; height: 60px; object-fit: cover; border-radius: 6px; cursor: pointer; transition: transform 0.2s; }
    .image-preview:hover { transform: scale(1.1); }

    .custom-file-upload {
        border: 2px dashed #ddd;
        border-radius: 6px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background-color: var(--card-bg);
        color: var(--text-color);
    }
    .custom-file-upload:hover {
        border-color: var(--primary-blue);
        background-color: rgba(0,0,0,0.05);
    }
    .custom-file-upload i {
        font-size: 2rem;
        color: var(--primary-blue);
        margin-bottom: 10px;
    }
    .custom-file-upload p, .custom-file-upload small {
        color: var(--text-color);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h2><i class="fa-solid fa-file-lines me-2"></i>Form Laporan Hyari Hatto</h2>
        <p>Formulir pelaporan temuan Hyari Hatto (Near Miss)</p>
    </div>

    <div class="form-card">
        <h5>I. Kondisi Temuan</h5>
        <form id="hyariForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="edit_id" name="id">

            <div class="row">
                <div class="col-md-6">
                    <h6>A. Perilaku Tidak Aman</h6>
                    @foreach($perilaku_tidak_aman as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="perilaku[]" value="{{ $item->id }}" id="perilaku{{ $item->id }}">
                            <label class="form-check-label" for="perilaku{{ $item->id }}">{{ $item->nama_perilaku }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <h6>B. Kondisi Tidak Aman</h6>
                    @foreach($kondisi_tidak_aman as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kondisi[]" value="{{ $item->id }}" id="kondisi{{ $item->id }}">
                            <label class="form-check-label" for="kondisi{{ $item->id }}">{{ $item->nama_kondisi }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr>

            <h5>II. Potensi Bahaya</h5>
            <div class="row">
                @foreach($potensi_bahaya as $item)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="potensi[]" value="{{ $item->id }}" id="potensi{{ $item->id }}">
                            <label class="form-check-label" for="potensi{{ $item->id }}">{{ $item->nama_potensi }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr>

            <h5>III. Deskripsi Temuan</h5>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Bukti Gambar</label>
                <div class="custom-file-upload" onclick="document.getElementById('bukti').click()">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p class="mb-0">Klik untuk upload gambar</p>
                    <small class="text-muted">Format: JPG, PNG (Max: 10MB)</small>
                </div>
                <input type="file" class="form-control d-none" id="bukti" name="bukti" accept="image/*">
                <div id="filePreview" class="mt-2"></div>
            </div>

            <hr>

            <h5>IV. Usulan</h5>
            <div class="mb-3">
                <textarea class="form-control" name="usulan" rows="3" placeholder="Masukkan usulan perbaikan..." required></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i>Simpan Data</button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fa-solid fa-rotate-left me-2"></i>Reset</button>
            </div>
        </form>
    </div>

    <div class="table-card">
        <h5>Data Laporan Hyari Hatto</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kondisi Temuan</th>
                        <th>Potensi Bahaya</th>
                        <th>Deskripsi</th>
                        <th>Bukti</th>
                        <th>Usulan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
                    </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('bukti').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('filePreview');
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width:200px;">`;
        }
        reader.readAsDataURL(file);
    }
});

function resetForm(){
    document.getElementById('hyariForm').reset();
    document.getElementById('edit_id').value='';
    document.getElementById('filePreview').innerHTML='';
}

// TODO: Submit, Edit, Delete logic via AJAX
</script>
@endpush