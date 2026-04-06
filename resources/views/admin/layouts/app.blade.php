<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-pink-50">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-pink-700 text-white flex flex-col shadow-lg shrink-0">
            <div class="p-6 border-b border-pink-600">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold tracking-wide">
                    🛒 ATK Admin
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-pink-600 text-white' : 'text-pink-100 hover:bg-pink-600 hover:text-white' }} transition">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.produk.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.produk*') ? 'bg-pink-600 text-white' : 'text-pink-100 hover:bg-pink-600 hover:text-white' }} transition">
                    📦 Produk
                </a>
                <a href="{{ route('admin.kategori.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.kategori*') ? 'bg-pink-600 text-white' : 'text-pink-100 hover:bg-pink-600 hover:text-white' }} transition">
                    🏷️ Kategori
                </a>
                <a href="{{ route('admin.pesanan.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.pesanan*') ? 'bg-pink-600 text-white' : 'text-pink-100 hover:bg-pink-600 hover:text-white' }} transition">
                    🛍️ Pesanan
                </a>
                <a href="{{ route('admin.user.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.user*') ? 'bg-pink-600 text-white' : 'text-pink-100 hover:bg-pink-600 hover:text-white' }} transition">
                    👥 Pengguna
                </a>
                <hr class="border-pink-600 my-2">
                <a href="{{ route('shop.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-pink-100 hover:bg-pink-600 hover:text-white transition">
                    🏠 Ke Toko
                </a>
            </nav>
            <div class="p-4 border-t border-pink-600 text-xs text-pink-200">
                Login sebagai <span class="font-semibold text-white">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="text-pink-300 hover:text-white underline">Logout</button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-pink-100 border-b border-pink-200 px-6 py-4 shadow-sm">
                <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Admin Panel')</h1>
            </header>
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
