<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 leading-tight italic tracking-tighter uppercase">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] shadow-2xl border border-pale-pink-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pale-pink-50/50">
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">User</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic">Email</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Role</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-center">Tanggal Join</th>
                                <th class="px-8 py-6 text-xs font-black text-pale-pink-600 uppercase tracking-widest italic text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pale-pink-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-pale-pink-50/30 transition duration-300 group">
                                    <td class="px-8 py-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pale-pink-500 to-pale-pink-700 flex items-center justify-center text-white font-black italic shadow-lg group-hover:rotate-12 transition">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <span class="font-black text-gray-900 italic tracking-tight text-lg">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 font-bold italic text-gray-500">{{ $user->email }}</td>
                                    <td class="px-8 py-8 text-center">
                                        @if($user->is_admin)
                                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-pale-pink-600 text-white italic shadow-lg shadow-pale-pink-100 border border-pale-pink-500">
                                                ADMINISTRATOR
                                            </span>
                                        @else
                                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-gray-100 text-gray-400 italic border border-gray-200">
                                                PELANGGAN
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-8 text-center text-sm font-medium text-gray-400 italic">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-8 py-8 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-2 bg-white text-gray-700 hover:text-blue-600 border border-gray-100 hover:border-blue-100 px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                            Edit
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="inline-flex items-center gap-2 bg-pale-pink-50 text-pale-pink-600 hover:bg-pale-pink-600 hover:text-white px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-sm active:scale-95 italic">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-8 border-t border-pale-pink-50">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
