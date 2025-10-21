@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    .main-content main {
        padding: 20px !important;
        background-color: #f8f9fa;
        min-height: calc(100vh - 72px);
    }

    /* Header simple biru */
    .page-header {
        background-color: #007bff;
        color: white;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    /* Kartu dan tombol */
    .form-card, .table-card {
        background: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-edit { background-color: #ffc107; color: #000; }
    .btn-delete { background-color: #dc3545; color: white; }
    .btn-edit:hover { background-color: #ffb300; transform: translateY(-2px); }
    .btn-delete:hover { background-color: #c82333; transform: translateY(-2px); }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h2><i class="fa-solid fa-triangle-exclamation"></i> Master Data Kondisi Tidak Aman</h2>
        <p>Pengelolaan daftar kondisi tidak aman di lingkungan kerja</p>
    </div>

    <!-- Form Tambah Data -->
    <div class="form-card">
        <h5><i class="fa-solid fa-plus-circle me-2"></i>Tambah Data</h5>
        <form id="kondisiForm">
            @csrf
            <div class="mb-3">
                <label for="nama_kondisi" class="form-label">Nama Kondisi</label>
                <input type="text" class="form-control" id="nama_kondisi" name="nama_kondisi" placeholder="Contoh: Lantai licin di area kerja" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                <label class="form-check-label" for="status">Aktif</label>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i>Simpan Data</button>
        </form>
    </div>

    <!-- Table Data -->
    <div class="table-card">
        <h5><i class="fa-solid fa-table me-2"></i>Data Kondisi Tidak Aman</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Kondisi</th>
                        <th width="15%">Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTable"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- 🔹 Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" class="modal-content">
      @csrf
      <input type="hidden" id="edit_id" name="id">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Data Kondisi</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label for="edit_nama_kondisi" class="form-label">Nama Kondisi</label>
              <input type="text" class="form-control" id="edit_nama_kondisi" name="nama_kondisi" required>
          </div>
          <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="edit_status" name="status">
              <label class="form-check-label" for="edit_status">Aktif</label>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i>Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('kondisiForm');
    const editForm = document.getElementById('editForm');
    const tbody = document.getElementById('dataTable');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    // 🔹 Load data dari server
    async function loadData() {
        const res = await fetch('/panel/manage/kondisitidakaman/data');
        const data = await res.json();
        tbody.innerHTML = '';

        data.forEach((item, index) => {
            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nama_kondisi}</td>
                    <td>${item.status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>'}</td>
                    <td>
                        <button class="btn btn-edit btn-sm" onclick="editData(${item.id})"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-delete btn-sm" onclick="deleteData(${item.id})"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>`;
        });
    }

    // 🔹 Tambah data
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const res = await fetch('/panel/manage/kondisitidakaman/store', {
            method: 'POST',
            body: formData
        });
        const result = await res.json();
        if (result.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: result.message,
                timer: 2000,
                showConfirmButton: false
            });
            form.reset();
            loadData();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: result.message
            });
        }
    });

    // 🔹 Edit data (tampilkan modal)
    window.editData = async function (id) {
        const res = await fetch(`/panel/manage/kondisitidakaman/show/${id}`);
        const data = await res.json();

        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_nama_kondisi').value = data.nama_kondisi;
        document.getElementById('edit_status').checked = data.status;

        editModal.show();
    };

    // 🔹 Simpan hasil edit
    editForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(editForm);
        const res = await fetch('/panel/manage/kondisitidakaman/store', {
            method: 'POST',
            body: formData
        });
        const result = await res.json();
        if (result.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: result.message,
                timer: 2000,
                showConfirmButton: false
            });
            editModal.hide();
            loadData();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: result.message
            });
        }
    });

    // 🔹 Hapus data
    window.deleteData = async function (id) {
        const result = await Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            const res = await fetch(`/panel/manage/kondisitidakaman/delete/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            const data = await res.json();
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                loadData();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message
                });
            }
        }
    };

    loadData();
});
</script>
@endpush
