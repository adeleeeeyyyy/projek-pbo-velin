<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-12 rounded-[3rem] shadow-2xl border border-pale-pink-100 space-y-10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-pale-pink-50 rounded-full blur-3xl opacity-50"></div>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Left Column -->
                        <div class="space-y-8">
                            <h3 class="text-xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Informasi Dasar</h3>

                            <div class="space-y-4">
                                <x-input-label for="name" :value="__('Nama Produk')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-lg font-bold italic" :value="old('name')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="space-y-4">
                                <x-input-label for="sku" :value="__('SKU / Kode Barang')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                                <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-lg font-bold italic uppercase" :value="old('sku')" placeholder="Contoh: SIDU-38" required />
                                <x-input-error class="mt-2" :messages="$errors->get('sku')" />
                            </div>

                            <div class="space-y-4">
                                <x-input-label for="category_id" :value="__('Kategori')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                                <select id="category_id" name="category_id" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-lg font-bold italic bg-pale-pink-50/20" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div class="space-y-4">
                                <x-input-label for="description" :value="__('Deskripsi')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                                <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 font-medium italic">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-8">
                            <h3 class="text-xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Harga & Stok</h3>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <x-input-label for="price" :value="__('Harga (Rp)')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                                    <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-xl font-black italic decoration-pale-pink-200 underline" :value="old('price')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                </div>
                                <div class="space-y-4">
                                    <x-input-label for="stock" :value="__('Stok Tersedia')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                                    <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-xl font-black italic" :value="old('stock', 0)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-xl font-black text-gray-900 border-l-8 border-pale-pink-500 pl-4 italic tracking-widest uppercase">Galeri Foto</h3>

                                <div class="space-y-4">
                                    <label for="images" class="relative group cursor-pointer block border-4 border-dashed border-pale-pink-100 rounded-[2rem] p-12 text-center hover:border-pale-pink-400 transition-all duration-500 hover:bg-pale-pink-50 group shadow-inner">
                                        <div class="space-y-4">
                                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto shadow-lg group-hover:scale-110 group-hover:rotate-6 transition duration-500">
                                                <svg class="w-8 h-8 text-pale-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-lg font-black text-gray-900 italic">Pilih Gambar Produk</p>
                                                <p class="text-xs text-gray-400 font-medium italic mt-1">Anda dapat memilih lebih dari satu gambar (JPG, PNG, WEBP)</p>
                                            </div>
                                        </div>
                                        <input id="images" name="images[]" type="file" multiple class="hidden" accept="image/*" onchange="previewImages(event)">
                                    </label>
                                    <x-input-error class="mt-2" :messages="$errors->get('images')" />

                                    <!-- Image Preview Container -->
                                    <div id="imagePreview" class="grid grid-cols-4 gap-4 mt-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-6 pt-10 border-t-4 border-dashed border-pale-pink-50">
                        <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-gray-600 font-black italic tracking-widest uppercase transition">Batal</a>
                        <button type="submit" class="bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-12 py-5 rounded-[2rem] font-black transition shadow-2xl shadow-pale-pink-200 hover:scale-[1.02] active:scale-95 italic uppercase tracking-widest text-xl">
                            Simpan Produk Premium
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImages(event) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            if (event.target.files) {
                Array.from(event.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'aspect-square rounded-2xl overflow-hidden border-2 border-pale-pink-100 shadow-sm relative group';
                        div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                        preview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</x-app-layout>
