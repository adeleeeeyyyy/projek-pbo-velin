<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('shop.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-pale-pink-600 transition">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Toko
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('shop.category', $product->category->slug) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-pale-pink-600 md:ml-2 transition">{{ $product->category->name }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-pale-pink-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:divide-x md:divide-pale-pink-50">
                    <!-- Image Gallery -->
                    <div class="p-8 space-y-4">
                        <div class="relative aspect-square rounded-2xl overflow-hidden border border-pale-pink-50 shadow-inner group">
                            @if($product->images && count($product->images) > 0)
                                <img id="mainImage" src="{{ asset('storage/products/card/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-pale-pink-50 flex items-center justify-center text-pale-pink-200">
                                    <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        @if($product->images && count($product->images) > 1)
                            <div class="grid grid-cols-4 gap-4">
                                @foreach($product->images as $image)
                                    <button onclick="document.getElementById('mainImage').src='{{ asset('storage/products/card/' . $image) }}'" class="aspect-square rounded-xl overflow-hidden border-2 border-transparent hover:border-pale-pink-500 transition shadow-sm focus:outline-none focus:border-pale-pink-500">
                                        <img src="{{ asset('storage/products/thumbnail/' . $image) }}" alt="Thumbnail" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="p-12 flex flex-col justify-between">
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <span class="text-pale-pink-600 font-bold tracking-wider uppercase text-sm italic">{{ $product->category->name }}</span>
                                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $product->name }}</h1>
                                <p class="text-sm font-medium text-gray-400">SKU: <span class="text-gray-600">{{ $product->sku }}</span></p>
                            </div>

                            <div class="flex items-center gap-4">
                                <p class="text-4xl font-black text-pale-pink-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <span class="bg-pale-pink-50 text-pale-pink-600 px-3 py-1 rounded-full text-sm font-bold border border-pale-pink-100">
                                    Tersedia: {{ $product->stock }} Item
                                </span>
                            </div>

                            <div class="prose prose-pale-pink max-w-none text-gray-600 border-t border-pale-pink-50 pt-8">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>

                        <div class="mt-12 space-y-4">
                            @if($product->stock > 0)
                                <form action="{{ route('cart.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center border border-pale-pink-200 rounded-2xl p-1 bg-pale-pink-50 w-32">
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="w-10 h-10 flex items-center justify-center text-pale-pink-600 hover:bg-pale-pink-100 rounded-xl transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                                            </button>
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-12 text-center border-none bg-transparent focus:ring-0 font-bold text-gray-700">
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="w-10 h-10 flex items-center justify-center text-pale-pink-600 hover:bg-pale-pink-100 rounded-xl transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                            </button>
                                        </div>
                                        <span class="text-sm font-medium text-gray-400 italic">Maksimal stok tersedia</span>
                                    </div>
                                    <button type="submit" class="w-full bg-pale-pink-600 hover:bg-pale-pink-700 text-white py-5 rounded-2xl font-black text-xl transition-all hover:scale-[1.02] shadow-xl shadow-pale-pink-200 active:scale-95">
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <div class="w-full bg-gray-100 text-gray-400 py-5 rounded-2xl font-black text-xl text-center cursor-not-allowed border border-gray-200">
                                    Stok Habis
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($related->count() > 0)
                <div class="mt-20">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Produk Terkait</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                        @foreach($related as $rel)
                            <a href="{{ route('products.show', $rel->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-pale-pink-50 hover:shadow-lg transition">
                                <div class="aspect-square overflow-hidden bg-pale-pink-50">
                                    @if($rel->images && count($rel->images) > 0)
                                        <img src="{{ asset('storage/products/card/' . $rel->images[0]) }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="font-bold text-gray-800 group-hover:text-pale-pink-600 transition truncate">{{ $rel->name }}</h3>
                                    <p class="text-pale-pink-600 font-extrabold mt-2 italic">Rp {{ number_format($rel->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
