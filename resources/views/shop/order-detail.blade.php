@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
        <div class="flex gap-3">
            <a href="{{ route('orders.nota', $pesanan) }}" target="_blank"
               class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">📄 Nota PDF</a>
            <a href="{{ route('orders.index') }}" class="text-pink-600 hover:underline text-sm">← Kembali</a>
        </div>
    </div>

    @php $colors = ['Pending'=>'bg-yellow-100 text-yellow-800','Menunggu Konfirmasi'=>'bg-orange-100 text-orange-800','Dikonfirmasi'=>'bg-blue-100 text-blue-800','Dikirim'=>'bg-purple-100 text-purple-800','Selesai'=>'bg-green-100 text-green-800','Dibatalkan'=>'bg-red-100 text-red-800']; @endphp

    <div class="bg-pink-50 border border-pink-100 rounded-xl p-5 mb-5">
        <div class="flex justify-between flex-wrap gap-3">
            <div>
                <p class="font-mono font-semibold text-gray-800">{{ $pesanan->order_number }}</p>
                <p class="text-sm text-gray-500">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-sm font-bold self-start {{ $colors[$pesanan->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $pesanan->status }}</span>
        </div>
    </div>

    {{-- Items --}}
    <div class="bg-white border border-pink-100 rounded-xl shadow-sm mb-5 overflow-hidden">
        <h2 class="px-5 py-4 font-semibold text-gray-700 bg-pink-50 border-b border-pink-100">Item Pesanan</h2>
        <table class="min-w-full text-sm divide-y divide-gray-100">
            <tbody class="bg-pink-50">
            @foreach($pesanan->detailPesanans as $d)
            <tr class="border-b border-pink-100">
                <td class="px-5 py-3">{{ $d->produk->nama ?? 'Produk dihapus' }}</td>
                <td class="px-5 py-3 text-center">{{ $d->jumlah }}</td>
                <td class="px-5 py-3 text-right">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                <td class="px-5 py-3 text-right font-bold">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-pink-100">
                    <td colspan="3" class="px-5 py-3 text-right font-bold text-gray-700">Total</td>
                    <td class="px-5 py-3 text-right font-bold text-pink-700 text-base">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Shipping address --}}
    <div class="bg-white border border-pink-100 rounded-xl shadow-sm p-5 mb-5">
        <h2 class="font-semibold text-gray-700 mb-3">Alamat Pengiriman</h2>
        <p class="text-sm text-gray-600"><strong>{{ $pesanan->name }}</strong></p>
        <p class="text-sm text-gray-600">{{ $pesanan->phone }}</p>
        <p class="text-sm text-gray-600">{{ $pesanan->address }}, {{ $pesanan->postal_code }}</p>
    </div>

    {{-- Status timeline --}}
    <div class="bg-white border border-pink-100 rounded-xl shadow-sm p-5">
        <h2 class="font-semibold text-gray-700 mb-4">Riwayat Status</h2>
        <ol class="space-y-3">
            @foreach($pesanan->statusHistories->sortByDesc('created_at') as $h)
            <li class="flex gap-3 text-sm">
                <span class="text-gray-400 shrink-0 text-xs pt-0.5">{{ $h->created_at->format('d M Y H:i') }}</span>
                <div>
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $colors[$h->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $h->status }}</span>
                    @if($h->note) <p class="text-gray-500 mt-1">{{ $h->note }}</p> @endif
                </div>
            </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection
