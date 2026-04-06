@extends('admin.layouts.app')
@section('title', 'Edit Role User')

@section('content')
<div class="max-w-md">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Role: {{ $user->name }}</h2>
    <form action="{{ route('admin.user.update', $user) }}" method="POST" class="bg-white rounded-xl border border-pink-100 shadow-sm p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="is_admin" value="0" {{ !$user->is_admin ? 'checked' : '' }}>
                    <span>User Biasa</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                    <span>Admin</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-lg font-semibold transition">Simpan</button>
            <a href="{{ route('admin.user.index') }}" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
