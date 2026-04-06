<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
            {{ __('Edit Kategori') }}: <span class="text-pale-pink-600">{{ $category->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-12 rounded-[3rem] shadow-2xl border border-pale-pink-100 space-y-10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-pale-pink-50 rounded-full blur-3xl opacity-50"></div>

                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <x-input-label for="name" :value="__('Nama Kategori')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-lg font-bold italic" :value="old('name', $category->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        <p class="text-xs text-gray-400 font-medium mb-2 italic">Slug Saat Ini: <span class="text-pale-pink-500 font-bold">{{ $category->slug }}</span></p>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-pale-pink-50">
                        <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-gray-700 font-bold transition italic">Batal</a>
                        <button type="submit" class="bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-10 py-4 rounded-2xl font-black transition shadow-xl shadow-pale-pink-100 hover:scale-[1.02] active:scale-95 italic uppercase tracking-widest text-lg">
                            Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
