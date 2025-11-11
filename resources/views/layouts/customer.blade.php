@extends('layouts.app')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('customer.dashboard') }}">Customer Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#customerNavbar" aria-controls="customerNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="customerNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'fw-bold' : '' }}" href="{{ route('customer.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.pemesanan.*') ? 'fw-bold' : '' }}" href="{{ route('customer.pemesanan.index') }}">Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.pembayaran.*') ? 'fw-bold' : '' }}" href="{{ route('customer.pembayaran.index') }}">Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.riwayat.*') ? 'fw-bold' : '' }}" href="#">Riwayat Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.profile.*') ? 'fw-bold' : '' }}" href="{{ route('customer.profile.edit') }}">Profile</a>
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
@yield('customer-content')
@endsection
