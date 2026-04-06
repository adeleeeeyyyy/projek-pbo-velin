@extends('admin.layouts.app')
@section('title', 'Detail Pesanan')

@section('content')
@php $colors = ['Pending'=>'bg-yellow-100 text-yellow-800','Menunggu Konfirmasi'=>'bg-orange-100 text-orange-800','Dikonfirmasi'=>'bg-blue-100 text-blue-800','Dikirim'=>'bg-purple-100 text-purple-800','Selesai'=>'bg-green-100 text-green-800','Dibatalkan'=>'bg-red-100 text-red-800']; @endphp
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">Pesanan: {{ $pesanan->order_number ?? '#'.$pesanan->id }}</h2>
    <div class="flex gap-3">
        <a href="{{ route('admin.pesanan.nota', $pesanan) }}" target="_blank"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">📄 Download Nota PDF</a>
        <a href="{{ route('admin.pesanan.index') }}" class="text-pink-600 hover:underline text-sm">← Kembali</a>
    </div>
</div>

<div class="grid grid-cols-3 gap-6">
    {{-- Order info --}}
    <div class="col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-pink-100 shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Item Pesanan</h3>
            <table class="min-w-full text-sm divide-y divide-gray-100">
                <thead class="bg-pink-50">
                    <tr>
                        <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500">Produk</th>
                        <th class="px-3 py-2 text-center text-xs font-semibold text-gray-500">Jumlah</th>
                        <th class="px-3 py-2 text-right text-xs font-semibold text-gray-500">Harga</th>
                        <th class="px-3 py-2 text-right text-xs font-semibold text-gray-500">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($pesanan->detailPesanans as $d)
                    <tr>
                        <td class="px-3 py-3">{{ $d->produk->nama ?? 'Produk dihapus' }}</td>
                        <td class="px-3 py-3 text-center">{{ $d->jumlah }}</td>
                        <td class="px-3 py-3 text-right">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                        <td class="px-3 py-3 text-right font-semibold">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-pink-50">
                        <td colspan="3" class="px-3 py-3 text-right font-bold text-gray-700">Total</td>
                        <td class="px-3 py-3 text-right font-bold text-pink-700 text-base">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Status History --}}
        <div class="bg-white rounded-xl border border-pink-100 shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Riwayat Status</h3>
            <ol class="space-y-3">
                @foreach($pesanan->statusHistories->sortByDesc('created_at') as $h)
                <li class="flex gap-3 text-sm">
                    <span class="text-gray-400 shrink-0 text-xs pt-0.5">{{ $h->created_at->format('d M Y H:i') }}</span>
                    <div>
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $colors[$h->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $h->status }}</span>
                        @if($h->note) <p class="text-gray-500 mt-1">{{ $h->note }}</p> @endif
                        <p class="text-gray-400 text-xs">oleh {{ $h->changedBy->name ?? 'Sistem' }}</p>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
    </div>

    {{-- Sidebar: buyer info + status update --}}
    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-pink-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-3">Info Pembeli</h3>
            <dl class="space-y-2 text-sm">
                <div><dt class="text-gray-500 text-xs">Nama</dt><dd class="font-medium">{{ $pesanan->name }}</dd></div>
                <div><dt class="text-gray-500 text-xs">Email</dt><dd>{{ $pesanan->email }}</dd></div>
                <div><dt class="text-gray-500 text-xs">Telepon</dt><dd>{{ $pesanan->phone }}</dd></div>
                <div><dt class="text-gray-500 text-xs">Alamat</dt><dd>{{ $pesanan->address }}</dd></div>
                <div><dt class="text-gray-500 text-xs">Kode Pos</dt><dd>{{ $pesanan->postal_code }}</dd></div>
            </dl>
        </div>

        <div class="bg-white rounded-xl border border-pink-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-3">Ubah Status</h3>
            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$pesanan->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $pesanan->status }}</span>
            <form action="{{ route('admin.pesanan.update', $pesanan) }}" method="POST" class="mt-4 space-y-3">
                @csrf @method('PUT')
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-pink-400 outline-none" required>
                    @foreach($statuses as $s)
                    <option value="{{ $s }}" {{ $pesanan->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                <textarea name="note" rows="2" placeholder="Catatan internal (opsional)"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-pink-400 outline-none"></textarea>
                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-lg font-semibold text-sm transition">Simpan Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
