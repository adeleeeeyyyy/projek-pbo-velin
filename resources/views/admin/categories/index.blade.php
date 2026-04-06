<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
                {{ __('Kelola Kategori') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-8 py-3 rounded-2xl font-black text-sm transition shadow-lg shadow-pale-pink-200 active:scale-95 italic uppercase tracking-widest">
                + Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] shadow-2xl border border-pale-pink-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pale-pink-50/50">
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">Nama Kategori</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Jumlah Produk</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pale-pink-50">
                            @foreach($categories as $category)
                                <tr class="hover:bg-pale-pink-50/30 transition duration-300 group">
                                    <td class="px-8 py-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-pale-pink-100 rounded-2xl flex items-center justify-center text-pale-pink-600 font-black italic shadow-inner group-hover:scale-110 transition">
                                                {{ substr($category->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-black text-gray-900 italic text-lg tracking-tight">{{ $category->name }}</p>
                                                <p class="text-xs text-gray-400 font-medium">Slug: /kategori/{{ $category->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="bg-white border-2 border-pale-pink-100 text-pale-pink-600 px-4 py-1 rounded-full text-sm font-black italic shadow-sm">
                                            {{ $category->products_count }} Produk
                                        </span>
                                    </td>
                                    <td class="px-8 py-8 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center gap-2 bg-white text-gray-700 hover:text-blue-600 border border-gray-100 hover:border-blue-100 px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" class="inline-flex items-center gap-2 bg-pale-pink-50 text-pale-pink-600 hover:bg-pale-pink-600 hover:text-white px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
