@extends('layouts.admin', ['title' => 'Corporate Actions Management'])

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-semibold">Corporate Actions / AGM</h3>
        @unlessrole('Viewer')
        <a href="{{ route('admin.corporate-actions.create') }}"
            class="btn-primary flex items-center px-6 py-2.5 rounded-full text-white font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            New Announcement
        </a>
        @endunlessrole
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/5 uppercase text-[10px] tracking-widest text-[#DC833D] font-bold">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($actions as $action)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 text-white text-sm font-medium">
                            {{ \Carbon\Carbon::parse($action->date)->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-orange-500/10 text-orange-400">
                                {{ $action->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-zinc-400 text-sm max-w-md truncate">{{ $action->title }}</td>
                        <td class="px-6 py-4 text-right space-x-3">
                            @unlessrole('Viewer')
                            <a href="{{ route('admin.corporate-actions.edit', $action) }}"
                                class="text-[#DC833D] hover:underline text-sm font-medium">Edit</a>
                            <form action="{{ route('admin.corporate-actions.destroy', $action) }}" method="POST" class="inline">
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
                        <td colspan="4" class="px-6 py-8 text-center text-zinc-500 italic">No announcements found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection