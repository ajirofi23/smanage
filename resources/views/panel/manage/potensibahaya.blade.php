@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .main-content main {
        padding: 20px !important;
        background-color: #f8f9fa;
        min-height: calc(100vh - 72px);
    }

    .page-header {
        background-color: #0d6efd;
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-card, .table-card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-edit { background-color: #ffc107; color: #000; }
    .btn-delete { background-color: #dc3545; color: white; }
    .btn-edit:hover { background-color: #e0a800; }
    .btn-delete:hover { background-color: #c82333; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h2><i class="bi bi-exclamation-octagon"></i> Master Data Potensi Bahaya</h2>
        <p>Pengelolaan daftar potensi bahaya di lingkungan kerja</p>
    </div>

    <!-- Form Tambah Data -->
    <div class="form-card">
        <h5><i class="bi bi-plus-circle me-2"></i>Tambah Data</h5>
        <form id="potensiForm">
            @csrf
            <div class="mb-3">
                <label for="nama_potensi" class="form-label">Nama Potensi Bahaya</label>
                <input type="text" class="form-control" id="nama_potensi" name="nama_potensi" placeholder="Contoh: Permukaan lantai licin" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                <label class="form-check-label" for="status">Aktif</label>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Data</button>
        </form>
    </div>

    <!-- Table Data -->
    <div class="table-card">
        <h5><i class="bi bi-table me-2"></i>Data Potensi Bahaya</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Potensi Bahaya</th>
                        <th width="15%">Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTable"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" class="modal-content">
      @csrf
      <input type="hidden" id="edit_id" name="id">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit Potensi Bahaya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label for="edit_nama_potensi" class="form-label">Nama Potensi Bahaya</label>
              <input type="text" class="form-control" id="edit_nama_potensi" name="nama_potensi" required>
          </div>
          <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="edit_status" name="status">
              <label class="form-check-label" for="edit_status">Aktif</label>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('potensiForm');
    const editForm = document.getElementById('editForm');
    const tbody = document.getElementById('dataTable');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    // Load data
    async function loadData() {
        const res = await fetch('/panel/manage/potensibahaya/data');
        const data = await res.json();
        tbody.innerHTML = '';

        data.forEach((item, index) => {
            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nama_potensi}</td>
                    <td>${item.status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>'}</td>
                    <td>
                        <button class="btn btn-edit btn-sm" onclick="editData(${item.id})"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-delete btn-sm" onclick="deleteData(${item.id})"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>`;
        });
    }

    // Tambah data
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const res = await fetch('/panel/manage/potensibahaya/store', {
            method: 'POST',
            body: formData
        });
        const result = await res.json();
        alert(result.message);
        form.reset();
        loadData();
    });

    // Tampilkan modal edit
    window.editData = async function (id) {
        const res = await fetch(`/panel/manage/potensibahaya/show/${id}`);
        const data = await res.json();

        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_nama_potensi').value = data.nama_potensi;
        document.getElementById('edit_status').checked = data.status;

        editModal.show();
    };

    // Simpan hasil edit
    editForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(editForm);
        const res = await fetch('/panel/manage/potensibahaya/store', {
            method: 'POST',
            body: formData
        });
        const result = await res.json();
        alert(result.message);
        editModal.hide();
        loadData();
    });

    // Hapus data
    window.deleteData = async function (id) {
        if (!confirm('Yakin ingin menghapus data ini?')) return;
        const res = await fetch(`/panel/manage/potensibahaya/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        const result = await res.json();
        alert(result.message);
        loadData();
    };

    loadData();
});
</script>
@endpush
