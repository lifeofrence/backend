@extends('layouts.admin', ['title' => 'Add New User'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.users.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">FullName</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none" placeholder="e.g. Admin User">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none" placeholder="admin@example.com">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Password</label>
                        <input type="password" name="password" required
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Assign Roles</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($roles as $role)
                            <label
                                class="flex items-center space-x-3 p-3 rounded-lg bg-white/5 border border-white/10 cursor-pointer hover:border-[#DC833D]/50 transition-colors">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                    class="w-4 h-4 rounded border-zinc-800 text-[#DC833D] focus:ring-[#DC833D] bg-zinc-900">
                                <span class="text-sm text-zinc-300">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    CREATE USER ACCOUNT
                </button>
            </form>
        </div>
    </div>
@endsection