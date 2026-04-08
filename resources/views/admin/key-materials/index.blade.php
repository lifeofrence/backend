@extends('layouts.admin', ['title' => 'Key Materials Management'])

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-semibold">Key Materials</h3>
        @unlessrole('Viewer')
        <a href="{{ route('admin.key-materials.create') }}"
            class="btn-primary flex items-center px-6 py-2.5 rounded-full text-white font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Upload New Category Material
        </a>
        @endunlessrole
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/5 uppercase text-[10px] tracking-widest text-[#DC833D] font-bold">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($key_materials as $material)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 text-white text-sm font-medium">{{ \Carbon\Carbon::parse($material->date)->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-zinc-400 text-sm">{{ $material->title }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-500/10 text-blue-400">
                                {{ str_replace('_', ' ', $material->category) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($material->is_active)
                                <span class="w-2 h-2 rounded-full bg-green-500 inline-block mr-2 shadow-[0_0_8px_rgba(34,197,94,0.6)]"></span>
                                <span class="text-xs text-green-500 font-medium capitalize">Active</span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-zinc-600 inline-block mr-2"></span>
                                <span class="text-xs text-zinc-500 font-medium capitalize">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ url('key-materials/' . basename($material->file_path)) }}" target="_blank"
                                class="text-zinc-500 hover:text-white text-sm font-medium">View</a>
                            <a href="{{ url('key-materials/' . basename($material->file_path) . '?download=1') }}"
                                class="text-zinc-500 hover:text-white text-sm font-medium">Download</a>
                            @unlessrole('Viewer')
                            <a href="{{ route('admin.key-materials.edit', $material) }}"
                                class="text-[#DC833D] hover:underline text-sm font-medium">Edit</a>
                            <form action="{{ route('admin.key-materials.destroy', $material) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm font-medium"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @endunlessrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-zinc-500 italic">No key materials found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
