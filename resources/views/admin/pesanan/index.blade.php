@extends('admin.layouts.app')
@section('title', 'Kelola Pesanan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">Pesanan</h2>
    <form method="GET" class="flex gap-2">
        <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-pink-400 outline-none">
            <option value="">Semua Status</option>
            @foreach($statuses as $s)
            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-pink-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-pink-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No. Pesanan</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Pelanggan</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Total</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @php $colors = ['Pending'=>'bg-yellow-100 text-yellow-800','Menunggu Konfirmasi'=>'bg-orange-100 text-orange-800','Dikonfirmasi'=>'bg-blue-100 text-blue-800','Dikirim'=>'bg-purple-100 text-purple-800','Selesai'=>'bg-green-100 text-green-800','Dibatalkan'=>'bg-red-100 text-red-800']; @endphp
            @forelse($pesanans as $p)
            <tr class="hover:bg-pink-50 transition">
                <td class="px-4 py-3 font-mono text-xs">{{ $p->order_number ?? '#'.$p->id }}</td>
                <td class="px-4 py-3">
                    <div class="font-medium">{{ $p->name ?? $p->user->name ?? '-' }}</div>
                    <div class="text-gray-400 text-xs">{{ $p->email ?? $p->user->email ?? '' }}</div>
                </td>
                <td class="px-4 py-3 font-semibold">Rp {{ number_format($p->total_harga,0,',','.') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$p->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $p->status }}</span>
                </td>
                <td class="px-4 py-3 text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
                <td class="px-4 py-3 text-center flex justify-center gap-3">
                    <a href="{{ route('admin.pesanan.show', $p) }}" class="text-pink-600 hover:underline">Detail</a>
                    <a href="{{ route('admin.pesanan.nota', $p) }}" target="_blank" class="text-gray-500 hover:underline text-xs">PDF</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="py-8 text-center text-gray-400">Belum ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $pesanans->links() }}</div>
</div>
@endsection
