<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-pale-pink-100 to-white overflow-hidden shadow-sm sm:rounded-3xl mb-12 border border-pale-pink-200">
                <div class="p-12 sm:p-20 flex flex-col md:flex-row items-center justify-between gap-12 text-center md:text-left">
                    <div class="flex-1 space-y-6">
                        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                            Solusi Lengkap <br>
                            <span class="text-pale-pink-600 italic">Buku & ATK</span> <br>
                            Untuk Anda
                        </h1>
                        <p class="text-lg text-gray-600 max-w-lg">
                            Temukan berbagai pilihan buku tulis dan peralatan kantor berkualitas dengan harga terbaik. Belanja mudah, cepat, dan terpercaya.
                        </p>
                        <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                            <a href="#katalog" class="bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-8 py-4 rounded-full font-bold text-lg transition shadow-lg shadow-pale-pink-200">
                                Mulai Belanja
                            </a>
                            <a href="#kategori" class="bg-white hover:bg-pale-pink-50 text-pale-pink-600 border-2 border-pale-pink-100 px-8 py-4 rounded-full font-bold text-lg transition">
                                Lihat Kategori
                            </a>
                        </div>
                    </div>
                    <div class="flex-1 w-full max-w-md">
                        <div class="relative">
                            <div class="absolute -top-10 -left-10 w-40 h-40 bg-pale-pink-200 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
                            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-pale-pink-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
                            <div class="relative bg-white p-4 rounded-2xl shadow-2xl rotate-3 border border-pale-pink-50">
                                <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&q=80&w=800" alt="ATK Premium" class="rounded-xl shadow-inner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Categories -->
            <div id="kategori" class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Kategori Pilihan</h2>
                    <a href="#" class="text-pale-pink-600 font-semibold hover:underline">Lihat Semua →</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($categories as $cat)
                        <a href="{{ route('shop.category', $cat->slug) }}" class="group bg-white p-8 rounded-2xl shadow-sm border border-pale-pink-100 hover:border-pale-pink-300 transition text-center">
                            <div class="w-16 h-16 bg-pale-pink-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pale-pink-100 transition">
                                <svg class="w-8 h-8 text-pale-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800">{{ $cat->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $cat->products_count }} Produk</p>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Products Grid -->
            <div id="katalog" class="mb-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <h2 class="text-3xl font-bold text-gray-900">Produk Terbaru</h2>
                    <div class="flex items-center gap-4">
                        <form action="{{ route('shop.index') }}" method="GET" class="relative group">
                            <input type="text" name="q" placeholder="Cari alat tulis..." class="pl-10 pr-4 py-2 border border-pale-pink-100 rounded-full w-64 focus:ring-pale-pink-500 focus:border-pale-pink-500 transition group-hover:border-pale-pink-300">
                            <svg class="w-5 h-5 absolute left-3 top-2.5 text-pale-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($products as $product)
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-pale-pink-50 flex flex-col h-full">
                            <div class="relative overflow-hidden aspect-square">
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/products/card/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-pale-pink-50 flex items-center justify-center text-pale-pink-200">
                                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="bg-white/90 backdrop-blur-sm text-pale-pink-600 px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-pale-pink-600 transition mb-2">
                                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <div class="flex items-center justify-between mt-auto">
                                    <p class="text-xl font-extrabold text-pale-pink-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500">Stok: {{ $product->stock }}</p>
                                </div>
                                <div class="mt-6 flex gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="flex-1 bg-pale-pink-50 text-pale-pink-600 hover:bg-pale-pink-600 hover:text-white text-center py-2.5 rounded-xl font-bold transition">
                                        Detail
                                    </a>
                                    <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-pale-pink-600 hover:bg-pale-pink-700 text-white py-2.5 rounded-xl font-bold transition">
                                            Beli
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
