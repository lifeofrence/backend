@extends('layouts.admin', ['title' => 'User Management'])

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-semibold">System Users</h3>
        <a href="{{ route('admin.users.create') }}"
            class="btn-primary flex items-center px-6 py-2.5 rounded-full text-white font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New User
        </a>
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/5 uppercase text-[10px] tracking-widest text-[#DC833D] font-bold">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Roles</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($users as $user)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-medium text-white">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-zinc-400 text-sm">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm">
                            @foreach($user->roles as $role)
                                <span
                                    class="px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-zinc-800 text-zinc-300 mr-1">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="text-[#DC833D] hover:underline text-sm font-medium">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm font-medium"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-zinc-500 italic">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection