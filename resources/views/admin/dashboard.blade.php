<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-pale-pink-50 relative overflow-hidden group hover:shadow-pale-pink-100 transition duration-500">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-pale-pink-50 rounded-full group-hover:scale-150 transition duration-700"></div>
                    <div class="relative flex items-center gap-6">
                        <div class="w-16 h-16 bg-pale-pink-600 rounded-3xl flex items-center justify-center text-white shadow-lg shadow-pale-pink-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-pale-pink-400 uppercase tracking-widest italic">Total Produk</p>
                            <p class="text-4xl font-black text-gray-900 tracking-tighter">{{ $totalProducts }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="mt-8 block text-sm font-bold text-pale-pink-600 hover:underline italic">Kelola Produk →</a>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-pale-pink-50 relative overflow-hidden group hover:shadow-pale-pink-100 transition duration-500">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-pale-pink-50 rounded-full group-hover:scale-150 transition duration-700"></div>
                    <div class="relative flex items-center gap-6">
                        <div class="w-16 h-16 bg-pale-pink-600 rounded-3xl flex items-center justify-center text-white shadow-lg shadow-pale-pink-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-pale-pink-400 uppercase tracking-widest italic">Pesanan Masuk</p>
                            <p class="text-4xl font-black text-gray-900 tracking-tighter">{{ $totalOrders }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="mt-8 block text-sm font-bold text-pale-pink-600 hover:underline italic">Lihat Pesanan →</a>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-pale-pink-50 relative overflow-hidden group hover:shadow-pale-pink-100 transition duration-500">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-pale-pink-50 rounded-full group-hover:scale-150 transition duration-700"></div>
                    <div class="relative flex items-center gap-6">
                        <div class="w-16 h-16 bg-pale-pink-600 rounded-3xl flex items-center justify-center text-white shadow-lg shadow-pale-pink-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-pale-pink-400 uppercase tracking-widest italic">Total Pengguna</p>
                            <p class="text-4xl font-black text-gray-900 tracking-tighter">{{ $totalUsers }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="mt-8 block text-sm font-bold text-pale-pink-600 hover:underline italic">Kelola User →</a>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white rounded-[3rem] shadow-2xl border border-pale-pink-50 overflow-hidden">
                <div class="p-10 border-b border-pale-pink-50 flex items-center justify-between flex-wrap gap-4">
                    <h3 class="text-2xl font-black text-gray-900 italic tracking-tighter uppercase">Pesanan Terbaru</h3>
                    <a href="{{ route('admin.orders.index') }}" class="bg-pale-pink-500 hover:bg-pale-pink-600 text-white px-6 py-2.5 rounded-2xl font-black text-sm transition italic">Lihat Semua Pesanan</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pale-pink-50/50">
                                <th class="px-8 py-5 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">No. Pesanan</th>
                                <th class="px-8 py-5 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">Pembeli</th>
                                <th class="px-8 py-5 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Status</th>
                                <th class="px-8 py-5 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pale-pink-50">
                            @foreach($recentOrders as $order)
                                <tr class="hover:bg-pale-pink-50/30 transition duration-300">
                                    <td class="px-8 py-6 font-black text-gray-900 italic">#{{ $order->order_number }}</td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-900 italic">{{ $order->user->name }}</span>
                                            <span class="text-xs text-gray-400 font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                         @php
                                            $statusColors = [
                                                'Pending' => 'bg-gray-100 text-gray-600',
                                                'Menunggu Konfirmasi' => 'bg-blue-100 text-blue-600',
                                                'Dikonfirmasi' => 'bg-pale-pink-100 text-pale-pink-600',
                                                'Dikirim' => 'bg-amber-100 text-amber-600',
                                                'Selesai' => 'bg-green-100 text-green-600',
                                                'Dibatalkan' => 'bg-red-100 text-red-600',
                                            ];
                                            $colorClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600';
                                        @endphp
                                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $colorClass }} italic shadow-sm border border-black/5">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-pale-pink-600 hover:text-pale-pink-700 font-black italic text-sm">Detail →</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
