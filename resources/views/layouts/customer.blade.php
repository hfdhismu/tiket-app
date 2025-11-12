@extends('layouts.app')

@section('navbar')
    <style>
        /* 🌸 Floating Sidebar (Customer) - Maroon Theme */
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 20px;
            left: 20px;
            height: calc(100vh - 40px);
            width: 240px;
            background: rgba(128, 0, 0, 0.95);
            color: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            z-index: 100;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .sidebar .brand {
            font-size: 1.3rem;
            font-weight: 700;
            text-align: center;
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .sidebar ul {
            list-style: none;
            margin: 0;
            padding: 1rem 0;
        }

        .sidebar ul li {
            margin: 4px 0;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 10px 22px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.25s ease;
            border-left: 3px solid transparent;
            border-radius: 8px;
        }

        .sidebar ul li a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar ul li a.active {
            background-color: #b03030;
            border-left: 3px solid #ffc107;
            color: #fff;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .content {
            margin-left: 280px;
            padding: 2rem;
            transition: all 0.3s;
        }

        .navbar-top {
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 0.9rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .logout-btn {
            border: none;
            background-color: #800000;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background-color: #5a0000;
        }

        /* 🔻 Mobile view */
        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.active {
                left: 20px;
            }

            .content {
                margin-left: 0;
            }
        }

        .text-maroon {
            color: #800000 !important;
        }

        .btn-outline-maroon {
            border: 1.5px solid #800000;
            color: #800000;
            background-color: transparent;
            transition: all 0.25s ease;
        }

        .btn-outline-maroon:hover {
            background-color: #800000;
            color: #fff;
        }
    </style>

    <!-- Floating Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">🎫 Customer Panel</div>
        <ul>
            <li><a href="{{ route('customer.dashboard') }}" class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a></li>
            <li><a href="{{ route('customer.pemesanan.index') }}" class="{{ request()->routeIs('customer.pemesanan.*') ? 'active' : '' }}">
                <i class="bi bi-ticket-perforated"></i> Pemesanan
            </a></li>
            <li><a href="{{ route('customer.pembayaran.index') }}" class="{{ request()->routeIs('customer.pembayaran.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i> Pembayaran
            </a></li>
            <li><a href="{{ route('customer.profile.edit') }}" class="{{ request()->routeIs('customer.profile.*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profile
            </a></li>
        </ul>
    </div>

    <!-- Top Navbar -->
    <div class="content">
        <div class="navbar-top">
            <button class="btn btn-outline-maroon d-lg-none" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <div class="user-name">
                <span class="fw-semibold text-maroon">Halo {{ Auth::user()->name }}, selamat datang!</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <main>
            @yield('customer-content')
        </main>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
@endsection
