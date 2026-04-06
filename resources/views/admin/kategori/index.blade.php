@extends('admin.layouts.app')
@section('title', 'Kelola Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">Kategori Produk</h2>
    <a href="{{ route('admin.kategori.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">+ Tambah Kategori</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-pink-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-pink-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Kategori</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Slug</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Jumlah Produk</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($kategoris as $k)
            <tr class="hover:bg-pink-50 transition">
                <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $k->nama_kategori }}</td>
                <td class="px-4 py-3 text-gray-500 font-mono text-xs">{{ $k->slug }}</td>
                <td class="px-4 py-3 text-center">{{ $k->produks_count }}</td>
                <td class="px-4 py-3 text-center flex justify-center gap-2">
                    <a href="{{ route('admin.kategori.edit', $k) }}" class="text-pink-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $kategoris->links() }}</div>
</div>
@endsection
