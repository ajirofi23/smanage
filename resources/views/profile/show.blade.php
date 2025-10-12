@extends('layouts.app')

@push('styles')
<style>
    .profile-card { background-color: var(--navbar-bg); border-radius: 10px; padding: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
    .profile-card img { width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--navbar-border-color); }
    .profile-details dl { margin-bottom: 0; }
    .profile-details dt { font-weight: 600; color: var(--sidebar-link-color); width: 120px; }
    .profile-details dd { color: var(--text-color-strong); }
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    {{-- Page Header --}}
    <div class="page-header mb-4" style="background-color: var(--sidebar-link-active-bg); color: var(--sidebar-link-active-color); padding: 25px; border-radius: 10px;">
        <h2 class="d-flex align-items-center gap-2"><i class="bi bi-person-circle"></i>Profil Pengguna</h2>
        <p class="mb-0 opacity-75">Lihat detail informasi akun Anda.</p>
    </div>

    {{-- Profile Content --}}
    <div class="profile-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center mb-4 mb-md-0">
                    <img src="https://i.pravatar.cc/150?u={{ $user->email }}" class="rounded-circle" alt="Foto Profil">
                </div>
                <div class="col-md-9 profile-details">
                    <h3 style="color: var(--text-color-strong);">{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->email }}</p>
                    <hr style="border-color: var(--navbar-border-color);">

                    <dl class="row">
                        <dt class="col-sm-3">Role</dt>
                        <dd class="col-sm-9 text-capitalize">{{ $user->role->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Bergabung Sejak</dt>
                        <dd class="col-sm-9">{{ $user->created_at->translatedFormat('d F Y') }}</dd>

                        <dt class="col-sm-3">Terakhir Update</dt>
                        <dd class="col-sm-9">{{ $user->updated_at->diffForHumans() }}</dd>
                    </dl>

                    <a href="#" class="btn btn-primary mt-3"><i class="bi bi-pencil-square me-2"></i>Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection