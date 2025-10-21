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

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .page-header h2 {
        margin: 0;
        font-weight: 600;
    }

    .page-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        border: none;
    }

    .form-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 20px 30px;
        margin: -30px -30px 30px -30px;
        border: none;
    }

    .form-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
    }

    .password-requirements {
        margin-top: 12px;
        font-size: 0.85em;
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .password-requirements li {
        list-style: none;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .password-requirements li.valid {
        color: #28a745;
    }

    .password-requirements li.invalid {
        color: #dc3545;
    }

    .password-requirements li.valid::before {
        content: "✓";
        font-weight: bold;
    }

    .password-requirements li.invalid::before {
        content: "✗";
        font-weight: bold;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        color: white;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .table-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        border: none;
    }

    .table-card .card-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 20px 30px;
        margin: -30px -30px 30px -30px;
        border: none;
    }

    .table-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-container {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .search-input {
        border: 2px solid #dee2e6;
        border-radius: 25px;
        padding: 10px 20px;
        font-size: 14px;
        width: 100%;
        max-width: 400px;
    }

    .search-input:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        outline: none;
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .table th {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        text-align: center;
        font-weight: 600;
        border: none;
        padding: 15px;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
        border: none;
        padding: 12px 15px;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .btn-action {
        border: none;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: white;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #e0a800 0%, #fd7e14 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #bd2130 0%, #a02622 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
    }

    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-link {
        border: none;
        border-radius: 8px;
        margin: 0 2px;
        color: #667eea;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background-color: #667eea;
        color: white;
        transform: translateY(-1px);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    @media (max-width: 768px) {
        .form-card, .table-card {
            padding: 20px;
        }

        .page-header {
            padding: 20px;
        }

        .table-responsive {
            font-size: 12px;
        }

        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h2><i class="fa-solid fa-user-plus"></i> Manajemen User</h2>
        <p>Kelola pengguna sistem dengan mudah dan aman</p>
    </div>

    {{-- Form Tambah User --}}
    <div class="form-card">
        <div class="card-header">
            <h5><i class="fa-solid fa-plus-circle"></i> Tambah User Baru</h5>
        </div>
        <form id="addUserForm">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fa-solid fa-user"></i> Nama Lengkap
                        </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fa-solid fa-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fa-solid fa-lock"></i> Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter dengan kombinasi yang kuat" required>
                        <ul class="password-requirements" id="password-requirements-add">
                            <li id="length-add" class="invalid">At least 8 characters long</li>
                            <li id="uppercase-add" class="invalid">At least one uppercase letter</li>
                            <li id="lowercase-add" class="invalid">At least one lowercase letter</li>
                            <li id="number-add" class="invalid">At least one number</li>
                            <li id="special-add" class="invalid">At least one special character from !@#$%^&*</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="role_id" class="form-label">
                            <i class="fa-solid fa-user-tag"></i> Role
                        </label>
                        <select class="form-select" id="role_id" name="role_id" required>
                            <option value="">Pilih Role</option>
                            <option value="1">Administrator</option>
                            <option value="2">Manager</option>
                            <option value="3">Supervisor</option>
                            <option value="4">Employee</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-submit">
                    <i class="fa-solid fa-save"></i> Simpan User
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Data User --}}
    <div class="table-card">
        <div class="card-header">
            <h5><i class="fa-solid fa-table"></i> Daftar User</h5>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="🔍 Cari nama atau email...">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="fa-solid fa-user"></i> Nama</th>
                        <th><i class="fa-solid fa-envelope"></i> Email</th>
                        <th><i class="fa-solid fa-user-tag"></i> Role</th>
                        <th><i class="fa-solid fa-cogs"></i> Aksi</th>
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
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addUserForm');
    const tableBody = document.querySelector('#userTable tbody');
    const searchInput = document.getElementById('searchInput');
    const pagination = document.getElementById('pagination');

    let users = [];
    let currentPage = 1;
    const rowsPerPage = 10;

    // 🔹 Load data user dari server
    async function loadUsers() {
        const res = await fetch('/panel/manage/add-user/data');
        users = await res.json();
        renderTable();
    }

    // 🔹 Render tabel + pagination
    function renderTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredUsers = users.filter(u =>
            u.name.toLowerCase().includes(searchTerm) ||
            u.email.toLowerCase().includes(searchTerm)
        );

        const start = (currentPage - 1) * rowsPerPage;
        const paginatedUsers = filteredUsers.slice(start, start + rowsPerPage);

        tableBody.innerHTML = paginatedUsers.map((u, i) => `
            <tr>
                <td>${start + i + 1}</td>
                <td>${u.name}</td>
                <td>${u.email}</td>
                <td><span class="badge bg-primary">${u.role_name}</span></td>
                <td>
                    <button class="btn btn-action btn-warning btn-sm me-1" onclick="editUser(${u.id}, '${u.name}', '${u.email}', ${u.role_id})">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn btn-action btn-danger btn-sm" onclick="deleteUser(${u.id})">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>
        `).join('');

        renderPagination(filteredUsers.length);
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

    // 🔹 Password validation function
    function validatePassword(password, prefix) {
        const length = password.length >= 8;
        const uppercase = /[A-Z]/.test(password);
        const lowercase = /[a-z]/.test(password);
        const number = /\d/.test(password);
        const special = /[!@#$%^&*]/.test(password);

        document.getElementById(`length-${prefix}`).className = length ? 'valid' : 'invalid';
        document.getElementById(`uppercase-${prefix}`).className = uppercase ? 'valid' : 'invalid';
        document.getElementById(`lowercase-${prefix}`).className = lowercase ? 'valid' : 'invalid';
        document.getElementById(`number-${prefix}`).className = number ? 'valid' : 'invalid';
        document.getElementById(`special-${prefix}`).className = special ? 'valid' : 'invalid';
    }

    // 🔹 Add password validation to add user form
    document.getElementById('password').addEventListener('input', function() {
        validatePassword(this.value, 'add');
    });

    // 🔹 Tambah user
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const res = await fetch('/panel/manage/add-user', {
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
            // Reset password validation to red
            validatePassword('', 'add');
            loadUsers();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: result.message
            });
        }
    });

    // 🔹 Edit user
    window.editUser = async function (id, name, email, role_id) {
        const { value: formValues } = await Swal.fire({
            title: 'Edit User',
            html: `
                <form id="edit-user-form">
                    <div class="mb-3">
                        <label for="swal-name" class="form-label">
                            <i class="fa-solid fa-user"></i> Nama
                        </label>
                        <input id="swal-name" class="form-control" placeholder="Nama" value="${name}" required>
                    </div>
                    <div class="mb-3">
                        <label for="swal-email" class="form-label">
                            <i class="fa-solid fa-envelope"></i> Email
                        </label>
                        <input id="swal-email" class="form-control" type="email" placeholder="Email" value="${email}" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="reset-password">
                            <label class="form-check-label" for="reset-password">
                                <i class="fa-solid fa-key"></i> Reset Password ke Default (P@ssw0rd123#)
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="swal-role" class="form-label">
                            <i class="fa-solid fa-user-tag"></i> Role
                        </label>
                        <select id="swal-role" class="form-control" required>
                            <option value="1" ${role_id == 1 ? 'selected' : ''}>Administrator</option>
                            <option value="2" ${role_id == 2 ? 'selected' : ''}>Manager</option>
                            <option value="3" ${role_id == 3 ? 'selected' : ''}>Supervisor</option>
                            <option value="4" ${role_id == 4 ? 'selected' : ''}>Employee</option>
                        </select>
                    </div>
                </form>
            `,
            focusConfirm: false,
            preConfirm: () => {
                const name = document.getElementById('swal-name').value;
                const email = document.getElementById('swal-email').value;
                const resetPassword = document.getElementById('reset-password').checked;
                const role_id = document.getElementById('swal-role').value;
                if (!name || !email || !role_id) {
                    Swal.showValidationMessage('Semua field wajib diisi');
                    return false;
                }
                return { name, email, password: resetPassword ? 'P@ssw0rd123#' : '', role_id };
            },
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#667eea'
        });

        if (formValues) {
            const res = await fetch(`/panel/manage/add-user/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formValues)
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
                loadUsers();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: result.message
                });
            }
        }
    }

    // 🔹 Hapus user
    window.deleteUser = async function (id) {
        const confirm = await Swal.fire({
            title: 'Yakin ingin hapus?',
            text: 'Data user akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });

        if (confirm.isConfirmed) {
            const res = await fetch(`/panel/manage/add-user/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
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
                loadUsers();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: result.message
                });
            }
        }
    }

    // 🔹 Muat data awal
    loadUsers();
});
</script>
@endpush
