@extends('layouts.admin', ['title' => 'Edit User'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.users.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">FullName</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                </div>

                <div class="p-4 bg-[#DC833D]/5 border border-[#DC833D]/20 rounded-lg">
                    <p class="text-[11px] text-[#DC833D] font-bold uppercase tracking-wider mb-2">Change Password</p>
                    <p class="text-xs text-zinc-500 mb-4">Leave both fields blank if you do not want to change the password.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-zinc-400">New Password</label>
                            <input type="password" name="password" class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-zinc-400">Confirm New Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Assign Roles</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($roles as $role)
                            <label
                                class="flex items-center space-x-3 p-3 rounded-lg bg-white/5 border border-white/10 cursor-pointer hover:border-[#DC833D]/50 transition-colors">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-zinc-800 text-[#DC833D] focus:ring-[#DC833D] bg-zinc-900">
                                <span class="text-sm text-zinc-300">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    UPDATE USER ACCOUNT
                </button>
            </form>
        </div>
    </div>
@endsection