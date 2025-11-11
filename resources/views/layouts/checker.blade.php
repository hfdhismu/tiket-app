@extends('layouts.app')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('checker.dashboard') }}">Checker Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#checkerNavbar" aria-controls="checkerNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="checkerNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('checker.dashboard') ? 'fw-bold' : '' }}" href="{{ route('checker.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('checker.surat-jalan.*') ? 'fw-bold' : '' }}" href="{{ route('checker.surat-jalan.index') }}">Surat Jalan</a>
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
@yield('checker-content')
@endsection
