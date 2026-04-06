<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
            {{ __('Edit Data Pengguna') }}: <span class="text-pale-pink-600 underline decoration-pale-pink-200">{{ $user->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-12 rounded-[3rem] shadow-2xl border border-pale-pink-100 space-y-10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-pale-pink-50 rounded-full blur-3xl opacity-50"></div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-lg font-bold italic" :value="old('name', $user->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="space-y-4">
                        <x-input-label for="email" :value="__('Email')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-2xl border-pale-pink-100 focus:border-pale-pink-500 focus:ring-pale-pink-500 transition shadow-inner p-4 text-lg font-bold italic" :value="old('email', $user->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="space-y-4">
                        <x-input-label for="is_admin" :value="__('Role / Hak Akses')" class="italic text-pale-pink-600 font-black tracking-widest uppercase" />
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="is_admin" value="0" class="peer hidden" {{ !$user->is_admin ? 'checked' : '' }}>
                                <div class="p-6 border-2 border-pale-pink-50 rounded-2xl bg-pale-pink-50/20 text-center font-black italic tracking-widest text-gray-400 transition peer-checked:bg-white peer-checked:border-pale-pink-500 peer-checked:text-pale-pink-600 peer-checked:shadow-xl peer-checked:shadow-pale-pink-50">
                                    PELANGGAN
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="is_admin" value="1" class="peer hidden" {{ $user->is_admin ? 'checked' : '' }}>
                                <div class="p-6 border-2 border-pale-pink-50 rounded-2xl bg-pale-pink-50/20 text-center font-black italic tracking-widest text-gray-400 transition peer-checked:bg-pale-pink-600 peer-checked:border-pale-pink-700 peer-checked:text-white peer-checked:shadow-xl peer-checked:shadow-pale-pink-200">
                                    ADMIN
                                </div>
                            </label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_admin')" />
                    </div>

                    <div class="flex items-center justify-end gap-6 pt-10 border-t-4 border-dashed border-pale-pink-50">
                        <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600 font-black italic tracking-widest uppercase transition">Batal</a>
                        <button type="submit" class="bg-pale-pink-600 hover:bg-pale-pink-700 text-white px-12 py-5 rounded-[2rem] font-black transition shadow-2xl shadow-pale-pink-200 hover:scale-[1.02] active:scale-95 italic uppercase tracking-widest text-xl">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
