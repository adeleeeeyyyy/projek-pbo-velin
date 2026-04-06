<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
                {{ __('Update Status Pesanan') }} #{{ $order->order_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-pale-pink-600 hover:text-pale-pink-700 font-black italic tracking-widest uppercase transition">← Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Order Info -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- Order Items -->
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-pale-pink-50 space-y-8">
                         <h3 class="text-xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Barang Pesanan</h3>
                         <div class="space-y-6">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-6 p-4 rounded-3xl hover:bg-pale-pink-50/50 transition">
                                    <div class="w-20 h-20 bg-pale-pink-50 rounded-2xl overflow-hidden shadow-inner flex-shrink-0">
                                        @if($item->product->images && count($item->product->images) > 0)
                                            <img src="{{ asset('storage/products/thumbnail/' . $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-black text-gray-900 italic tracking-tight truncate">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-400 font-bold italic">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-xl font-black text-pale-pink-600 italic">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                         </div>
                         <div class="pt-8 border-t-4 border-dashed border-pale-pink-50 flex justify-between items-center">
                            <span class="text-sm font-black text-gray-400 uppercase tracking-widest italic">Total Yang Harus Dibayar</span>
                            <span class="text-4xl font-black text-pale-pink-600 tracking-tighter italic decoration-double underline decoration-pale-pink-200">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                         </div>
                    </div>

                    <!-- History Timeline -->
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-pale-pink-50 space-y-8">
                        <h3 class="text-xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Riwayat Status</h3>
                        <div class="relative pl-8 border-l-2 border-dashed border-pale-pink-200 space-y-8">
                            @foreach($order->statusHistories as $history)
                                <div class="relative">
                                    <div class="absolute -left-[2.05rem] mt-1.5 w-4 h-4 rounded-full bg-white border-4 border-pale-pink-500"></div>
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-black text-pale-pink-400 uppercase tracking-widest italic">{{ $history->created_at->format('d M Y, H:i') }} oleh {{ $history->changedBy?->name ?? 'System' }}</p>
                                        <h4 class="text-lg font-black text-gray-900 italic tracking-tight">{{ $history->status }}</h4>
                                        <p class="bg-pale-pink-50 p-4 rounded-2xl border border-pale-pink-50 text-gray-600 font-medium italic text-sm">"{{ $history->note }}"</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Update Form & Customer Info -->
                <div class="space-y-8">
                    <!-- Update Status -->
                    <div class="bg-white p-10 rounded-[3rem] shadow-2xl border border-pale-pink-50 space-y-8 relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-pale-pink-50 rounded-full blur-3xl opacity-50"></div>
                        <h3 class="text-xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase relative">Ubah Status</h3>

                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-6 relative">
                            @csrf
                            @method('PUT')
                            <div class="space-y-3">
                                <x-input-label for="status" :value="__('Status Baru')" class="italic text-pale-pink-600 font-black tracking-widest uppercase text-xs" />
                                <select id="status" name="status" class="w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 p-4 font-black italic shadow-inner bg-pale-pink-50/20 text-sm" required>
                                    @foreach(['Pending', 'Menunggu Konfirmasi', 'Dikonfirmasi', 'Dikirim', 'Selesai', 'Dibatalkan'] as $status)
                                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-3">
                                <x-input-label for="note" :value="__('Catatan Perubahan')" class="italic text-pale-pink-600 font-black tracking-widest uppercase text-xs" />
                                <textarea id="note" name="note" rows="4" class="w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 p-4 font-medium italic shadow-inner text-sm" placeholder="Contoh: Pembayaran sudah diverifikasi via WA" required></textarea>
                            </div>

                            <button type="submit" class="w-full bg-pale-pink-600 hover:bg-pale-pink-700 text-white py-5 rounded-2xl font-black text-lg transition-all shadow-xl shadow-pale-pink-100 hover:scale-[1.02] active:scale-95 italic uppercase tracking-widest">
                                Update Pesanan
                            </button>
                        </form>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-10 rounded-[3rem] shadow-2xl text-white space-y-8">
                         <h3 class="text-lg font-black border-l-4 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Detail Pengiriman</h3>
                         <div class="space-y-6">
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-pale-pink-400 tracking-widest uppercase italic">Nama Pelanggan</p>
                                <p class="text-xl font-black italic tracking-tight">{{ $order->name }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-pale-pink-400 tracking-widest uppercase italic">Kontak</p>
                                <p class="text-sm font-bold italic">{{ $order->email }}</p>
                                <p class="text-sm font-black text-pale-pink-300 italic">{{ $order->phone }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-pale-pink-400 tracking-widest uppercase italic">Alamat Lengkap</p>
                                <p class="text-sm font-medium leading-relaxed italic bg-white/5 p-4 rounded-2xl border border-white/5">{{ $order->address }}</p>
                                <p class="text-lg font-black mt-2 italic flex items-center gap-2">
                                    <svg class="w-5 h-5 text-pale-pink-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                    {{ $order->postal_code }}
                                </p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
