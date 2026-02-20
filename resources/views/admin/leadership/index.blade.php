@extends('layouts.admin', ['title' => 'Leadership Management'])

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-semibold">Leadership Members</h3>
        @unlessrole('Viewer')
        <a href="{{ route('admin.leadership.create') }}"
            class="btn-primary flex items-center px-6 py-2.5 rounded-full text-white font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Member
        </a>
        @endunlessrole
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/5 uppercase text-[10px] tracking-widest text-[#DC833D] font-bold">
                <tr>
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Type</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($members as $member)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            <img src="{{ Str::startsWith($member->image_path, '/') ? $member->image_path : Storage::url($member->image_path) }}"
                                alt="{{ $member->name }}" class="w-10 h-10 rounded-full object-cover border border-white/10">
                        </td>
                        <td class="px-6 py-4 font-medium text-white">{{ $member->name }}</td>
                        <td class="px-6 py-4 text-zinc-400 text-sm">{{ $member->title }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span
                                class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $member->type == 'board' ? 'bg-indigo-500/10 text-indigo-400' : 'bg-emerald-500/10 text-emerald-400' }}">
                                {{ $member->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            @unlessrole('Viewer')
                            <a href="{{ route('admin.leadership.edit', $member) }}"
                                class="text-[#DC833D] hover:underline text-sm font-medium">Edit</a>
                            <form action="{{ route('admin.leadership.destroy', $member) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm font-medium"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @else
                            <span class="text-zinc-600 italic text-xs uppercase tracking-widest font-bold">Read Only</span>
                            @endunlessrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-zinc-500 italic">No members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection