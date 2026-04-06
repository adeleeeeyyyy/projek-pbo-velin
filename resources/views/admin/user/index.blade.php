@extends('admin.layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
<h2 class="text-xl font-bold text-gray-800 mb-6">Pengguna Terdaftar</h2>

<div class="bg-white rounded-xl shadow-sm border border-pink-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-pink-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Role</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Terdaftar</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($users as $u)
            <tr class="hover:bg-pink-50 transition">
                <td class="px-4 py-3 font-medium">{{ $u->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $u->email }}</td>
                <td class="px-4 py-3 text-center">
                    @if($u->is_admin)
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-700">Admin</span>
                    @else
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">User</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-center text-gray-400">{{ $u->created_at->format('d M Y') }}</td>
                <td class="px-4 py-3 text-center flex justify-center gap-2">
                    <a href="{{ route('admin.user.edit', $u) }}" class="text-pink-600 hover:underline">Edit Role</a>
                    @if($u->id !== auth()->id())
                    <form action="{{ route('admin.user.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $users->links() }}</div>
</div>
@endsection
