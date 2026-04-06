<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="min-h-screen bg-pale-pink-50 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-pale-pink-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-pale-pink-100 mt-auto">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-black italic tracking-tighter text-pale-pink-600">ATK<span class="text-gray-800">Pro</span></span>
                        </div>
                        <p class="text-sm text-gray-500 italic font-medium text-center md:text-left">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Pwellin ATK') }}. Hak Cipta Dilindungi.
                        </p>
                        <div class="flex space-x-6 text-sm text-gray-500 font-medium">
                            <a href="#" class="hover:text-pale-pink-600 transition">Tentang Kami</a>
                            <a href="#" class="hover:text-pale-pink-600 transition">Kebijakan Privasi</a>
                            <a href="#" class="hover:text-pale-pink-600 transition">Kontak</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
