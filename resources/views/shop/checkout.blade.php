<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
                <svg class="w-8 h-8 text-pale-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Checkout Pesanan
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Form Checkout -->
                <div class="lg:col-span-2">
                    <form action="{{ route('checkout.process') }}" method="POST" class="bg-white p-10 rounded-3xl shadow-xl border border-pale-pink-100 space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <h2 class="text-xl font-bold text-gray-900 border-l-4 border-pale-pink-500 pl-4 italic">Informasi Penerima</h2>
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="name" :value="__('Nama Lengkap')" class="italic text-pale-pink-600 font-bold" />
                                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner" :value="old('name', Auth::user()->name)" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" class="italic text-pale-pink-600 font-bold" />
                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner" :value="old('email', Auth::user()->email)" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                    <div>
                                        <x-input-label for="phone" :value="__('Nomor Telepon')" class="italic text-pale-pink-600 font-bold" />
                                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner" :value="old('phone')" placeholder="Contoh: 08123456789" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h2 class="text-xl font-bold text-gray-900 border-l-4 border-pale-pink-500 pl-4 italic">Alamat Pengiriman</h2>
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="address" :value="__('Alamat Lengkap')" class="italic text-pale-pink-600 font-bold" />
                                        <textarea id="address" name="address" rows="4" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner" required>{{ old('address') }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                    </div>
                                    <div>
                                        <x-input-label for="postal_code" :value="__('Kode Pos')" class="italic text-pale-pink-600 font-bold" />
                                        <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner" :value="old('postal_code')" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-pale-pink-50">
                            <div class="bg-pale-pink-50 p-6 rounded-2xl border border-pale-pink-100 flex items-start gap-4">
                                <svg class="w-6 h-6 text-pale-pink-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <p class="font-bold text-gray-900 italic underline decoration-pale-pink-300">Catatan Penting:</p>
                                    <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                                        Pesanan Anda akan segera diproses setelah admin melakukan konfirmasi. Pastikan data yang Anda masukkan sudah benar agar tidak terjadi kendala saat pengiriman.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-pale-pink-600 hover:bg-pale-pink-700 text-white py-6 rounded-2xl font-black text-2xl transition-all shadow-xl shadow-pale-pink-200 hover:scale-[1.01] active:scale-95">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                </div>

                <!-- Ringkasan Pesanan -->
                <div>
                    <div class="bg-white p-8 rounded-3xl shadow-lg border border-pale-pink-50 space-y-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2 italic">
                            <svg class="w-5 h-5 text-pale-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Barang Anda
                        </h2>
                        <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($carts as $item)
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-pale-pink-50 rounded-xl overflow-hidden flex-shrink-0 border border-pale-pink-100 shadow-sm">
                                        @if($item->product->images && count($item->product->images) > 0)
                                            <img src="{{ asset('storage/products/thumbnail/' . $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-bold text-gray-800 truncate italic">{{ $item->product->name }}</h3>
                                        <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-sm font-black text-pale-pink-600 italic">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pt-6 border-t border-pale-pink-100 flex justify-between items-center flex-wrap gap-4">
                            <span class="text-lg font-bold text-gray-900 italic">Total Pembayaran</span>
                            <span class="text-2xl font-black text-pale-pink-600 decoration-double underline decoration-pale-pink-300">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #fee4e6; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #fb7185; border-radius: 10px; }
    </style>
</x-app-layout>
