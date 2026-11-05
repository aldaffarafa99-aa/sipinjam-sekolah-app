<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Barang | Inventaris Sekolah</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-shell">

<div class="app-background-shape shape-one"></div>
<div class="app-background-shape shape-two"></div>

<nav class="app-navbar navbar navbar-light">
    <div class="container-fluid app-container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <span class="brand-mark"><img src="{{ asset('images/logo-sipinjam.jpg') }}" alt="Logo SIPINJAM"></span>
            <span><strong>Peminjaman</strong><small>Barang Sekolah</small></span>
        </a>
        <div class="app-primary-nav-wrap">
            <ul class="navbar-nav app-primary-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-grid-1x2-fill me-2"></i>Dashboard</a>
                </li>
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}"><i class="bi bi-box-seam me-2"></i>Data Barang</a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle border-0 bg-transparent" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-collection me-2"></i>Data Master
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}"><i class="bi bi-tags me-2"></i>Kategori</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('lokasi-barang.*') ? 'active' : '' }}" href="{{ route('lokasi-barang.index') }}"><i class="bi bi-geo-alt me-2"></i>Lokasi barang</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('barang.index') ? 'active' : '' }}" href="{{ route('barang.index') }}"><i class="bi bi-box-seam me-2"></i>Katalog</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}"><i class="bi bi-arrow-left-right me-2"></i>Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('notifikasi.*') ? 'active' : '' }}" href="{{ route('notifikasi.index') }}"><i class="bi bi-bell me-2"></i>Notifikasi @if(auth()->user()->unreadNotifications->count())<span class="badge bg-warning text-dark">{{ auth()->user()->unreadNotifications->count() }}</span>@endif</a>
                </li>
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}"><i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link admin-nav-label"><i class="bi bi-shield-check me-2"></i>Mode Admin</span>
                    </li>
                @endif
            </ul>
        </div>
        @auth
        <ul class="navbar-nav app-account-nav">
            <li class="nav-item dropdown profile-nav-item">
                <button type="button" class="profile-nav-link" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Buka menu profil">
                    @if (auth()->user()->avatar_path)
                        <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Foto profil" class="user-avatar user-avatar-image">
                    @else
                        <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    @endif
                    <span class="profile-nav-copy">
                        <span class="profile-nav-name">{{ auth()->user()->name }}</span>
                        <small class="user-role">{{ auth()->user()->role === 'admin' ? 'Admin Sarpras' : (auth()->user()->role === 'guru' ? 'Guru' : 'Siswa') }}</small>
                    </span>
                    <i class="bi bi-chevron-down profile-nav-chevron"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end profile-dropdown border-0 shadow">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-gear me-2"></i>{{ auth()->user()->role === 'admin' ? 'Profil Admin' : 'Profil Saya' }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-logout btn-sm"><i class="bi bi-box-arrow-right me-1"></i>Keluar</button>
                </form>
            </li>
        </ul>
        @endauth
    </div>
</nav>

<main class="app-main container-fluid app-container py-4 py-lg-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
