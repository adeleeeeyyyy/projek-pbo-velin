@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Pesanan</h1>

    @if($pesanans->isEmpty())
    <div class="bg-pink-50 border border-pink-100 rounded-xl p-12 text-center">
        <p class="text-4xl mb-3">🛍️</p>
        <p class="text-gray-500 mb-4">Belum ada pesanan.</p>
        <a href="{{ route('shop.index') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg font-semibold transition">Mulai Belanja</a>
    </div>
    @else
    <div class="space-y-4">
        @php $colors = ['Pending'=>'bg-yellow-100 text-yellow-800','Menunggu Konfirmasi'=>'bg-orange-100 text-orange-800','Dikonfirmasi'=>'bg-blue-100 text-blue-800','Dikirim'=>'bg-purple-100 text-purple-800','Selesai'=>'bg-green-100 text-green-800','Dibatalkan'=>'bg-red-100 text-red-800']; @endphp
        @foreach($pesanans as $p)
        <div class="bg-pink-50 border border-pink-100 rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start flex-wrap gap-3">
                <div>
                    <p class="font-mono text-sm font-semibold text-gray-700">{{ $p->order_number ?? '#'.$p->id }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $p->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $colors[$p->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $p->status }}</span>
            </div>
            <div class="mt-3 text-sm text-gray-600">
                <p>{{ $p->detailPesanans->count() }} item &bull; 
                   <span class="font-bold text-pink-700">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                </p>
            </div>
            <div class="mt-3 flex gap-3">
                <a href="{{ route('orders.show', $p) }}" class="text-pink-600 hover:underline text-sm">Detail</a>
                <a href="{{ route('orders.nota', $p) }}" target="_blank" class="text-gray-500 hover:underline text-sm">Nota PDF</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $pesanans->links() }}</div>
    @endif
</div>
@endsection
