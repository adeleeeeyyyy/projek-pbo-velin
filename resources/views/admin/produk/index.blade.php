@extends('admin.layouts.app')
@section('title', 'Kelola Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">Produk</h2>
    <a href="{{ route('admin.produk.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">+ Tambah Produk</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-pink-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-pink-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Produk</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">SKU</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Harga</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Stok</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($produks as $p)
            <tr class="hover:bg-pink-50 transition">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        @php $imgs = $p->gambar; $thumb = is_array($imgs) && count($imgs) > 0 ? $imgs[0]['thumb'] ?? null : null; @endphp
                        @if($thumb)
                            <img src="{{ asset('storage/' . $thumb) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                            <div class="w-10 h-10 rounded-lg bg-pink-100 flex items-center justify-center text-pink-400 text-xs">ATK</div>
                        @endif
                        <span class="font-medium text-gray-800">{{ $p->nama }}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $p->sku }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $p->kategori->nama_kategori ?? '-' }}</td>
                <td class="px-4 py-3 text-right font-semibold">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="{{ $p->stok <= 5 ? 'text-red-600 font-bold' : 'text-gray-700' }}">{{ $p->stok }}</span>
                </td>
                <td class="px-4 py-3 text-center flex justify-center gap-2">
                    <a href="{{ route('admin.produk.edit', $p) }}" class="text-pink-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.produk.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $produks->links() }}</div>
</div>
@endsection
