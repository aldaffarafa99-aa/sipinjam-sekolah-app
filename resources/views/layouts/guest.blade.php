<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Peminjaman Barang | Inventaris Sekolah</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="auth-shell min-h-screen font-sans text-slate-900 antialiased">
        <div class="auth-guest-shell relative flex min-h-screen flex-col items-center justify-center px-4 py-10 sm:px-6">
            <div class="relative z-10 mb-6">
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-3 rounded-2xl border border-white/70 bg-white/80 p-3 shadow-lg shadow-indigo-100/60 backdrop-blur">
                    <span class="flex h-11 w-20 items-center justify-center overflow-hidden rounded-xl bg-white p-1">
                        <x-application-logo class="h-full w-full" />
                    </span>
                    <span class="text-sm font-semibold leading-tight text-slate-800">Peminjaman Barang<small class="block text-xs font-medium text-slate-500">Sekolah · SIPINJAM</small></span>
                </a>
            </div>

            <div class="relative z-10 w-full max-w-md overflow-hidden rounded-3xl border border-white/80 bg-white/90 px-6 py-6 shadow-xl shadow-indigo-100/70 backdrop-blur sm:px-8 sm:py-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
