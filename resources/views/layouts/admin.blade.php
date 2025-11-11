@extends('layouts.app')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'fw-bold' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'fw-bold' : '' }}" href="{{ route('admin.jadwal.index') }}">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kursi.*') ? 'fw-bold' : '' }}" href="{{ route('admin.kursi.index') }}">Kursi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pemesanan.*') ? 'fw-bold' : '' }}" href="{{ route('admin.pemesanan.index') }}">Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.surat-jalan.*') ? 'fw-bold' : '' }}" href="{{ route('admin.surat-jalan.index') }}">Surat Jalan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'fw-bold' : '' }}" href="{{ route('admin.laporan.index') }}">Laporan</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-light" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
@yield('admin-content')
@endsection
