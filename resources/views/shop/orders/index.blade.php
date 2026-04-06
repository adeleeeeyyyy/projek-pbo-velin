<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-3 italic">
                <svg class="w-8 h-8 text-pale-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Riwayat Pesanan Saya
            </h1>

            @if($orders->count() > 0)
                <div class="bg-white rounded-3xl shadow-xl border border-pale-pink-50 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-pale-pink-50 border-b border-pale-pink-100">
                                    <th class="px-6 py-5 text-sm font-black text-pale-pink-700 uppercase tracking-widest italic">Nomor Pesanan</th>
                                    <th class="px-6 py-5 text-sm font-black text-pale-pink-700 uppercase tracking-widest italic">Tanggal</th>
                                    <th class="px-6 py-5 text-sm font-black text-pale-pink-700 uppercase tracking-widest italic">Total</th>
                                    <th class="px-6 py-5 text-sm font-black text-pale-pink-700 uppercase tracking-widest italic text-center">Status</th>
                                    <th class="px-6 py-5 text-sm font-black text-pale-pink-700 uppercase tracking-widest italic text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-pale-pink-50">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-pale-pink-50/30 transition-colors group">
                                        <td class="px-6 py-6 ring-pale-pink-50 ring-inset group-hover:ring-1">
                                            <span class="font-black text-gray-900 tracking-tighter italic">#{{ $order->order_number }}</span>
                                        </td>
                                        <td class="px-6 py-6 text-gray-600 font-medium">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-6">
                                            <span class="font-extrabold text-pale-pink-600 italic">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            @php
                                                $statusColors = [
                                                    'Pending' => 'bg-gray-100 text-gray-600 border-gray-200',
                                                    'Menunggu Konfirmasi' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                    'Dikonfirmasi' => 'bg-pale-pink-100 text-pale-pink-600 border-pale-pink-200',
                                                    'Dikirim' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                    'Selesai' => 'bg-green-50 text-green-600 border-green-100',
                                                    'Dibatalkan' => 'bg-red-50 text-red-600 border-red-100',
                                                ];
                                                $colorClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                                            @endphp
                                            <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest border {{ $colorClass }} italic shadow-sm">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-6 text-right space-x-2 whitespace-nowrap">
                                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center gap-2 bg-white text-gray-700 hover:text-pale-pink-600 border border-pale-pink-100 hover:border-pale-pink-300 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                                Detail
                                            </a>
                                            <a href="{{ route('orders.nota', $order) }}" target="_blank" class="inline-flex items-center gap-2 bg-pale-pink-500 hover:bg-pale-pink-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-md shadow-pale-pink-100 active:scale-95 italic">
                                                Nota
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="bg-white p-20 rounded-3xl shadow-sm border border-pale-pink-50 text-center space-y-6">
                    <div class="w-32 h-32 bg-pale-pink-50 rounded-full flex items-center justify-center mx-auto shadow-inner">
                        <svg class="w-16 h-16 text-pale-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 italic">Belum Ada Pesanan Nih!</h2>
                        <p class="text-gray-500 mt-2">Yuk mulai belanja alat tulis dan buku favoritmu sekarang.</p>
                    </div>
                    <a href="{{ route('shop.index') }}" class="inline-block bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-10 py-4 rounded-full font-bold transition shadow-lg shadow-pale-pink-200 active:scale-95">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
