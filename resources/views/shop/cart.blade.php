<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
                <svg class="w-8 h-8 text-pale-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Keranjang Belanja
            </h1>

            @if($carts->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <div class="lg:col-span-2 space-y-6">
                        @foreach($carts as $cart)
                            <div class="bg-white p-6 rounded-3xl shadow-sm border border-pale-pink-100 flex items-center gap-6 group hover:border-pale-pink-300 transition">
                                <div class="flex items-center">
                                    <form action="{{ route('cart.toggle', $cart) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-6 h-6 rounded-full border-2 border-pale-pink-200 flex items-center justify-center transition-colors {{ $cart->is_selected ? 'bg-pale-pink-500 border-pale-pink-500' : 'hover:border-pale-pink-400' }}">
                                            @if($cart->is_selected)
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>

                                <div class="w-24 h-24 rounded-2xl overflow-hidden bg-pale-pink-50 flex-shrink-0">
                                    @if($cart->product->images && count($cart->product->images) > 0)
                                        <img src="{{ asset('storage/products/thumbnail/' . $cart->product->images[0]) }}" alt="{{ $cart->product->name }}" class="w-full h-full object-cover">
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-900 group-hover:text-pale-pink-600 transition truncate">{{ $cart->product->name }}</h3>
                                    <p class="text-pale-pink-600 font-extrabold text-lg mt-1 group-hover:italic transition">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-400 mt-1 italic">Tersedia: {{ $cart->product->stock }} Item</p>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="flex items-center bg-pale-pink-50 rounded-xl p-1 border border-pale-pink-100">
                                        <form action="{{ route('cart.update', $cart) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $cart->quantity - 1 }}">
                                            <button type="submit" {{ $cart->quantity <= 1 ? 'disabled' : '' }} class="w-8 h-8 flex items-center justify-center text-pale-pink-600 hover:bg-white rounded-lg transition disabled:opacity-30">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                            </button>
                                        </form>
                                        <span class="w-12 text-center font-bold text-gray-700">{{ $cart->quantity }}</span>
                                        <form action="{{ route('cart.update', $cart) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $cart->quantity + 1 }}">
                                            <button type="submit" {{ $cart->quantity >= $cart->product->stock ? 'disabled' : '' }} class="w-8 h-8 flex items-center justify-center text-pale-pink-600 hover:bg-white rounded-lg transition disabled:opacity-30">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                    <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-xl hover:bg-red-50">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="lg:sticky lg:top-24 h-fit">
                        <div class="bg-white p-8 rounded-3xl shadow-xl border border-pale-pink-100 space-y-6">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-pale-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                Ringkasan Belanja
                            </h2>
                            <div class="space-y-3 border-b border-pale-pink-50 pb-6">
                                <div class="flex justify-between text-gray-500">
                                    <span>Total Barang</span>
                                    <span>{{ $carts->where('is_selected', true)->sum('quantity') }} Item</span>
                                </div>
                                <div class="flex justify-between text-gray-500 italic">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-2 flex-wrap sm:flex-nowrap gap-4">
                                <span class="text-lg font-bold text-gray-900">Total Harga</span>
                                <span class="text-2xl font-black text-pale-pink-600 tracking-tight">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('checkout.show') }}" class="block w-full bg-pale-pink-600 hover:bg-pale-pink-700 text-white text-center py-5 rounded-2xl font-black text-xl transition-all shadow-xl shadow-pale-pink-100 hover:scale-[1.02] active:scale-95">
                                Lanjut ke Checkout
                            </a>
                            <p class="text-xs text-gray-400 text-center italic">
                                * Stok akan otomatis dikurangi setelah checkout berhasil.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white p-20 rounded-3xl shadow-sm border border-pale-pink-50 text-center space-y-6">
                    <div class="w-32 h-32 bg-pale-pink-50 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-16 h-16 text-pale-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 italic">Wah, Keranjangmu Masih Kosong!</h2>
                        <p class="text-gray-500 mt-2">Yuk cari buku dan alat tulis impianmu sekarang.</p>
                    </div>
                    <a href="{{ route('shop.index') }}" class="inline-block bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-10 py-4 rounded-full font-bold transition shadow-lg shadow-pale-pink-100">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
