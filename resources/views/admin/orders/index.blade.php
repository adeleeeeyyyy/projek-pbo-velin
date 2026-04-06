<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
            {{ __('Kelola Pesanan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] shadow-2xl border border-pale-pink-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pale-pink-50/50">
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">No. Pesanan</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">Tanggal</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">Pelanggan</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Total</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Status</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pale-pink-50">
                            @foreach($orders as $order)
                                <tr class="hover:bg-pale-pink-50/30 transition duration-300 group">
                                    <td class="px-8 py-8">
                                        <span class="font-black text-gray-900 italic tracking-tighter text-lg underline decoration-pale-pink-200">#{{ $order->order_number }}</span>
                                    </td>
                                    <td class="px-8 py-8 text-sm font-medium text-gray-500 italic">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-8 py-8">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-900 italic tracking-tight">{{ $order->name }}</span>
                                            <span class="text-xs text-pale-pink-400 font-bold uppercase tracking-widest">{{ $order->phone }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="font-black text-gray-900 italic tracking-tighter">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-8 py-8 text-center">
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
                                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $colorClass }} italic shadow-sm">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-8 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-2 bg-white text-gray-700 hover:text-pale-pink-600 border border-gray-100 hover:border-pale-pink-100 px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                            Kelola
                                        </a>
                                        <a href="{{ route('admin.orders.nota', $order) }}" target="_blank" class="inline-flex items-center gap-2 bg-pale-pink-50 text-pale-pink-600 hover:bg-pale-pink-600 hover:text-white px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                            Nota
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-8 border-t border-pale-pink-50">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
