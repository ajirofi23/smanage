@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    .main-content main {
        padding: 20px !important;
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

    .form-card, .table-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border-color);
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        color: var(--text-color);
    }

    .form-card h5, .table-card h5 {
        color: var(--text-color-strong);
    }

    .form-label {
        color: var(--text-color);
    }

    .table {
        background-color: var(--table-bg);
        color: var(--text-color);
    }

    .table thead {
        background-color: var(--table-header-bg);
        color: var(--table-header-color);
    }

    .table tbody tr {
        background-color: var(--table-bg);
        color: var(--text-color);
    }

    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.05);
    }

    .badge {
        color: var(--text-color);
    }

    .btn-primary {
        background-color: #007bff !important;
        border: none;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
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
        <h2><i class="fa-solid fa-triangle-exclamation"></i> Master Data Perilaku Tidak Aman</h2>
        <p>Pengelolaan daftar perilaku tidak aman di lingkungan kerja</p>
    </div>

    <!-- Form Tambah Data -->
    <div class="form-card">
        <h5><i class="fa-solid fa-plus-circle me-2"></i>Tambah Data</h5>
        <form id="perilakuForm">
            @csrf
            <div class="mb-3">
                <label for="nama_perilaku" class="form-label">Nama Perilaku</label>
                <input type="text" class="form-control" id="nama_perilaku" name="nama_perilaku" placeholder="Contoh: Tidak menggunakan APD" required>
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
        <div class="card-header">
            <h5><i class="fa-solid fa-table"></i> Data Perilaku Tidak Aman</h5>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="🔍 Cari nama perilaku...">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="perilakuTable">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th>Nama Perilaku</th>
                        <th width="15%">Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>
</div>

<!-- 🔹 Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" class="modal-content">
      @csrf
      <input type="hidden" id="edit_id" name="id">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Data Perilaku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label for="edit_nama_perilaku" class="form-label">Nama Perilaku</label>
              <input type="text" class="form-control" id="edit_nama_perilaku" name="nama_perilaku" required>
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
    const form = document.getElementById('perilakuForm');
    const editForm = document.getElementById('editForm');
    const tableBody = document.querySelector('#perilakuTable tbody');
    const searchInput = document.getElementById('searchInput');
    const pagination = document.getElementById('pagination');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    let perilakuData = [];
    let currentPage = 1;
    const rowsPerPage = 10;

    // 🔹 Load data dari server
    async function loadData() {
        const res = await fetch('/panel/manage/perilakutidakaman/data');
        perilakuData = await res.json();
        renderTable();
    }

    // 🔹 Render tabel + pagination
    function renderTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredData = perilakuData.filter(item =>
            item.nama_perilaku.toLowerCase().includes(searchTerm)
        );

        const start = (currentPage - 1) * rowsPerPage;
        const paginatedData = filteredData.slice(start, start + rowsPerPage);

        tableBody.innerHTML = paginatedData.map((item, i) => `
            <tr>
                <td>${start + i + 1}</td>
                <td>${item.nama_perilaku}</td>
                <td>${item.status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>'}</td>
                <td>
                    <button class="btn btn-edit btn-sm" onclick="editData(${item.id})"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-delete btn-sm" onclick="deleteData(${item.id})"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        `).join('');

        renderPagination(filteredData.length);
    }

    // 🔹 Pagination control
    function renderPagination(totalRows) {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.classList.add('page-item');
            if (i === currentPage) li.classList.add('active');

            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.addEventListener('click', e => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            });

            pagination.appendChild(li);
        }
    }

    // 🔹 Real-time search
    searchInput.addEventListener('input', () => {
        currentPage = 1;
        renderTable();
    });

    // 🔹 Tambah data
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const res = await fetch('/panel/manage/perilakutidakaman/store', {
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

    // 🔹 Tampilkan modal edit
    window.editData = async function (id) {
        const res = await fetch(`/panel/manage/perilakutidakaman/show/${id}`);
        const data = await res.json();

        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_nama_perilaku').value = data.nama_perilaku;
        document.getElementById('edit_status').checked = data.status;

        editModal.show();
    };

    // 🔹 Simpan hasil edit
    editForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(editForm);

        const res = await fetch('/panel/manage/perilakutidakaman/store', {
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
            const res = await fetch(`/panel/manage/perilakutidakaman/delete/${id}`, {
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
