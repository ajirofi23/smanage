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
        background-color: #007bff;
        color: white;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

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

    .table th {
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .pagination {
        justify-content: center;
    }

    .password-requirements {
        margin-top: 10px;
        font-size: 0.9em;
    }

    .password-requirements li {
        list-style: none;
        margin-bottom: 5px;
    }

    .password-requirements li.valid {
        color: green;
    }

    .password-requirements li.invalid {
        color: red;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h2><i class="fa-solid fa-user-plus"></i> Manajemen User</h2>
        <p>Tambah, ubah, atau hapus user dalam sistem</p>
    </div>

    {{-- Form Tambah User --}}
    <div class="form-card">
        <h5><i class="fa-solid fa-plus-circle me-2"></i>Tambah User</h5>
        <form id="addUserForm">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter, huruf besar, kecil, angka, simbol" required>
                    <ul class="password-requirements" id="password-requirements-add">
                        <li id="length-add" class="invalid">At least 8 characters long</li>
                        <li id="uppercase-add" class="invalid">At least one uppercase letter</li>
                        <li id="lowercase-add" class="invalid">At least one lowercase letter</li>
                        <li id="number-add" class="invalid">At least one number</li>
                        <li id="special-add" class="invalid">At least one special character from !@#$%^&*</li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        <option value="">Pilih Role</option>
                        <option value="1">Administrator</option>
                        <option value="2">Manager</option>
                        <option value="3">Supervisor</option>
                        <option value="4">Employee</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i>Simpan User</button>
        </form>
    </div>

    {{-- Tabel Data User --}}
    <div class="table-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="fa-solid fa-table me-2"></i>Daftar User</h5>
            <input type="text" id="searchInput" class="form-control w-25" placeholder="🔍 Cari nama atau email...">
        </div>

        <table class="table table-bordered table-striped" id="userTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
                <td>${u.role_name}</td>
                <td>
                    <button class="btn btn-warning btn-sm me-1" onclick="editUser(${u.id}, '${u.name}', '${u.email}', ${u.role_id})">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser(${u.id})">
                        <i class="fa-solid fa-trash"></i>
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
            Swal.fire('Berhasil', result.message, 'success');
            form.reset();
            // Reset password validation to red
            validatePassword('', 'add');
            loadUsers();
        } else {
            Swal.fire('Gagal', result.message, 'error');
        }
    });

    // 🔹 Edit user
    window.editUser = async function (id, name, email, role_id) {
        const { value: formValues } = await Swal.fire({
            title: 'Edit User',
            html: `
                <form id="edit-user-form">
                    <div class="mb-3">
                        <label for="swal-name" class="form-label">Nama</label>
                        <input id="swal-name" class="form-control" placeholder="Nama" value="${name}" required>
                    </div>
                    <div class="mb-3">
                        <label for="swal-email" class="form-label">Email</label>
                        <input id="swal-email" class="form-control" type="email" placeholder="Email" value="${email}" required>
                    </div>
                    <div class="mb-3">
                        <label for="swal-password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input id="swal-password" class="form-control" type="password" placeholder="Minimal 8 karakter, huruf besar, kecil, angka, simbol">
                        <ul class="password-requirements" id="password-requirements-edit">
                            <li id="length-edit" class="invalid">At least 8 characters long</li>
                            <li id="uppercase-edit" class="invalid">At least one uppercase letter</li>
                            <li id="lowercase-edit" class="invalid">At least one lowercase letter</li>
                            <li id="number-edit" class="invalid">At least one number</li>
                            <li id="special-edit" class="invalid">At least one special character from !@#$%^&*</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="swal-role" class="form-label">Role</label>
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
            didOpen: () => {
                document.getElementById('swal-password').addEventListener('input', function() {
                    validatePassword(this.value, 'edit');
                });
            },
            preConfirm: () => {
                const name = document.getElementById('swal-name').value;
                const email = document.getElementById('swal-email').value;
                const password = document.getElementById('swal-password').value;
                const role_id = document.getElementById('swal-role').value;
                if (!name || !email || !role_id) {
                    Swal.showValidationMessage('Semua field wajib diisi kecuali password');
                    return false;
                }
                return { name, email, password, role_id };
            }
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
                Swal.fire('Berhasil', result.message, 'success');
                loadUsers();
            } else {
                Swal.fire('Gagal', result.message, 'error');
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
                Swal.fire('Berhasil', result.message, 'success');
                loadUsers();
            } else {
                Swal.fire('Gagal', result.message, 'error');
            }
        }
    }

    // 🔹 Muat data awal
    loadUsers();
});
</script>
@endpush
