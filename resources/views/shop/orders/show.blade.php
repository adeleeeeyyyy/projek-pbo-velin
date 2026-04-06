<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div>
                    <a href="{{ route('orders.index') }}" class="text-pale-pink-600 hover:text-pale-pink-700 font-bold flex items-center gap-2 mb-2 transition italic group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Daftar Pesanan
                    </a>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter italic">Detail Pesanan #{{ $order->order_number }}</h1>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('orders.nota', $order) }}" target="_blank" class="bg-white border-2 border-pale-pink-100 hover:border-pale-pink-300 text-pale-pink-600 px-6 py-3 rounded-2xl font-black transition flex items-center gap-3 shadow-sm active:scale-95 italic">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Print Nota
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Order Items & Details -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- Status Timeline -->
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-pale-pink-100 space-y-8 relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-pale-pink-50 rounded-full blur-3xl opacity-50"></div>
                        <h2 class="text-2xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Status Perjalanan</h2>
                        <div class="relative pl-8 border-l-2 border-dashed border-pale-pink-200 space-y-10">
                            @foreach($order->statusHistories as $history)
                                <div class="relative">
                                    <div class="absolute -left-[2.05rem] mt-1.5 w-4 h-4 rounded-full bg-white border-4 border-pale-pink-500 shadow-sm animate-pulse"></div>
                                    <div class="space-y-1">
                                        <p class="text-xs font-black text-pale-pink-400 uppercase tracking-widest">{{ $history->created_at->format('d M Y, H:i') }}</p>
                                        <h3 class="text-lg font-black text-gray-900 italic tracking-tight">{{ $history->status }}</h3>
                                        <p class="text-gray-600 leading-relaxed font-medium bg-pale-pink-50/50 p-4 rounded-2xl border border-pale-pink-50 italic">"{{ $history->note }}"</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Item List -->
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-pale-pink-100 space-y-10 relative overflow-hidden">
                        <h2 class="text-2xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Barang Yang Dibeli</h2>
                        <div class="space-y-8">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-8 group">
                                    <div class="w-24 h-24 bg-pale-pink-50 rounded-3xl overflow-hidden shadow-inner flex-shrink-0 group-hover:scale-105 transition duration-500">
                                        @if($item->product->images && count($item->product->images) > 0)
                                            <img src="{{ asset('storage/products/thumbnail/' . $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 space-y-1 min-w-0">
                                        <h3 class="text-xl font-black text-gray-900 truncate italic tracking-tighter group-hover:text-pale-pink-600 transition">{{ $item->product->name }}</h3>
                                        <p class="text-gray-500 font-bold italic">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-2xl font-black text-pale-pink-600 italic tracking-widest underline decoration-pale-pink-200 decoration-double">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pt-10 border-t-2 border-dashed border-pale-pink-100 flex flex-col items-end gap-2">
                            <span class="text-sm font-black text-gray-400 uppercase tracking-widest italic">Total Seluruhnya</span>
                            <span class="text-5xl font-black text-pale-pink-600 tracking-tighter">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Details -->
                <div class="space-y-8">
                    <div class="bg-gradient-to-br from-pale-pink-600 to-pale-pink-800 p-10 rounded-[3rem] shadow-2xl text-white space-y-8 relative overflow-hidden transition hover:shadow-pale-pink-300">
                        <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                        <h2 class="text-xl font-black border-l-4 border-white pl-4 italic tracking-widest uppercase">Tujuan Pengiriman</h2>
                        <div class="space-y-6">
                            <div class="space-y-1">
                                <p class="text-xs font-black text-pale-pink-200 tracking-widest uppercase">Nama Penerima</p>
                                <p class="text-lg font-black italic">{{ $order->name }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs font-black text-pale-pink-200 tracking-widest uppercase">Kontak</p>
                                <p class="text-base font-bold italic">{{ $order->email }} / {{ $order->phone }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs font-black text-pale-pink-200 tracking-widest uppercase">Alamat Lengkap</p>
                                <p class="text-base font-medium leading-relaxed italic bg-white/10 p-4 rounded-2xl">{{ $order->address }}</p>
                                <p class="text-lg font-black mt-2 italic decoration-white decoration-wavy underline">Kode Pos: {{ $order->postal_code }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[3rem] border-2 border-pale-pink-50 space-y-6 shadow-xl">
                         <div class="flex items-center gap-4 text-pale-pink-600 mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h2 class="text-xl font-black italic tracking-widest uppercase">Pembayaran</h2>
                         </div>
                         <p class="text-gray-600 text-sm leading-relaxed font-medium italic">
                            Silakan lakukan pembayaran sesuai dengan total yang tertera. Admin akan memverifikasi pesanan Anda segera.
                         </p>
                         <div class="bg-pale-pink-50 p-4 rounded-2xl border border-pale-pink-100 italic font-bold text-pale-pink-800 text-center">
                            Admin akan mengontak Anda via WhatsApp/Email untuk instruksi pembayaran manual.
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
