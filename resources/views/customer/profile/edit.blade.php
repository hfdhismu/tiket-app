@extends('layouts.customer')

@section('title', 'Edit Profile')

@section('customer-content')
<h1 class="mb-4 text-primary-custom">Edit Profile</h1>

<form action="{{ route('customer.profile.edit') }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password (Kosongkan jika tidak ingin diganti)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <button class="btn btn-primary-custom">Update Profile</button>
</form>
@endsection