<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
                {{ __('Kelola Produk') }}
            </h2>
            <a href="{{ route('admin.products.create') }}" class="bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-8 py-3 rounded-2xl font-black text-sm transition shadow-lg shadow-pale-pink-200 active:scale-95 italic uppercase tracking-widest">
                + Tambah Produk
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
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">Produk</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">SKU</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Kategori</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Harga</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Stok</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pale-pink-50">
                            @foreach($products as $product)
                                <tr class="hover:bg-pale-pink-50/30 transition duration-300 group">
                                    <td class="px-8 py-8">
                                        <div class="flex items-center gap-6">
                                            <div class="w-16 h-16 bg-pale-pink-50 rounded-2xl overflow-hidden shadow-inner border border-pale-pink-100 flex-shrink-0 group-hover:scale-110 transition duration-500">
                                                @if($product->images && count($product->images) > 0)
                                                    <img src="{{ asset('storage/products/thumbnail/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-black text-gray-900 italic text-lg tracking-tight truncate">{{ $product->name }}</p>
                                                <p class="text-xs text-pale-pink-400 font-bold italic truncate">Slug: /product/{{ $product->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="font-bold text-gray-500 italic uppercase tabular-nums tracking-widest">{{ $product->sku }}</span>
                                    </td>
                                    <td class="px-8 py-8 text-center text-sm font-black italic text-pale-pink-600 uppercase tracking-tight">
                                        {{ $product->category->name }}
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="font-black text-gray-900 italic tracking-tighter text-lg underline decoration-pale-pink-200">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-8 py-8 text-center">
                                        <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest {{ $product->stock > 5 ? 'bg-green-50 text-green-600 border-green-100' : 'bg-red-50 text-red-600 border-red-100' }} border italic shadow-sm">
                                            {{ $product->stock }} Item
                                        </span>
                                    </td>
                                    <td class="px-8 py-8 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-2 bg-white text-gray-700 hover:text-blue-600 border border-gray-100 hover:border-blue-100 px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="inline-flex items-center gap-2 bg-pale-pink-50 text-pale-pink-600 hover:bg-pale-pink-600 hover:text-white px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-8 border-t border-pale-pink-50">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
