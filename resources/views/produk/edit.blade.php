<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk ATK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @error('nama') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kategori_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                                <select name="kategori_id" id="kategori_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $k)
                                        <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp):</label>
                                <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @error('harga') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @error('stok') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Saat Ini:</label>
                            @if($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar {{ $produk->nama }}" class="h-32 w-32 object-cover rounded mb-2">
                            @else
                                <p class="text-gray-500 text-sm mb-2">Belum ada gambar.</p>
                            @endif
                            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Ganti Gambar Produk (Opsional):</label>
                            <input type="file" name="gambar" id="gambar" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('gambar') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                                Perbarui
                            </button>
                            <a href="{{ route('produk.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
