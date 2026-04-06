@extends('admin.layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-lg">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Kategori</h2>
    <form action="{{ route('admin.kategori.store') }}" method="POST" class="bg-white rounded-xl border border-pink-100 shadow-sm p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 outline-none" required>
            @error('nama_kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-lg font-semibold transition">Simpan</button>
            <a href="{{ route('admin.kategori.index') }}" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
