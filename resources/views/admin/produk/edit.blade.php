@extends('admin.layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="max-w-2xl">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Produk: {{ $produk->nama }}</h2>
    <form action="{{ route('admin.produk.update', $produk) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl border border-pink-100 shadow-sm p-6 space-y-5">
        @csrf @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $produk->nama) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 outline-none" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $produk->sku) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" min="0" step="100"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 outline-none" required>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 outline-none">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            </div>

            {{-- Show existing images --}}
            @if(is_array($produk->gambar) && count($produk->gambar) > 0)
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($produk->gambar as $idx => $img)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $img['card']) }}" class="w-20 h-20 rounded-lg object-cover border border-pink-100">
                        <label class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs cursor-pointer">
                            <input type="checkbox" name="hapus_gambar[]" value="{{ $idx }}" class="hidden">✕
                        </label>
                    </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-400 mt-1">Centang tanda ✕ untuk menghapus foto tertentu.</p>
            </div>
            @endif

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tambah Foto Baru <span class="text-gray-400 text-xs">(maks. {{ env('MAX_IMAGES', 5) }} total)</span>
                </label>
                <input type="file" name="gambar[]" multiple accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-400 outline-none">
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-lg font-semibold transition">Update</button>
            <a href="{{ route('admin.produk.index') }}" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
