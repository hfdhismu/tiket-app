@extends('layouts.customer')

@section('title', 'Edit Profile')

@section('customer-content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-semibold text-primary-custom">Edit Profil</h2>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <form action="{{ route('customer.profile.edit') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password (kosongkan jika tidak ingin diganti)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary-custom rounded-pill px-4 fw-semibold">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .text-primary-custom {
        color: #800000 !important; /* maroon */
    }

    .btn-primary-custom {
        background-color: #800000;
        color: #fff;
        border: none;
        transition: all 0.25s ease;
    }

    .btn-primary-custom:hover {
        background-color: #5a0000;
        color: #fff;
    }

    .card {
        transition: all 0.25s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .form-control:focus {
        border-color: #800000;
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.2);
    }
</style>
@endsection
