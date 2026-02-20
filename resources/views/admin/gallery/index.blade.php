@extends('layouts.admin', ['title' => 'Gallery Management'])

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-semibold">Media Gallery</h3>
        @unlessrole('Viewer')
        <a href="{{ route('admin.gallery.create') }}"
            class="btn-primary flex items-center px-6 py-2.5 rounded-full text-white font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Upload New Image
        </a>
        @endunlessrole
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($items as $item)
            <div class="card overflow-hidden group">
                <div class="relative h-48">
                    <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @unlessrole('Viewer')
                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-4">
                        <a href="{{ route('admin.gallery.edit', $item) }}"
                            class="p-2 bg-white/10 hover:bg-[#DC833D] rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="inline">
                            @csrf@method('DELETE')
                            <button type="submit" class="p-2 bg-white/10 hover:bg-red-500 rounded-full transition-colors"
                                onclick="return confirm('Delete this image?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endunlessrole
                </div>
                <div class="p-4">
                    <h4 class="text-sm font-medium text-white truncate">{{ $item->title }}</h4>
                    <div class="flex justify-between items-center mt-2">
                        <span
                            class="text-[10px] uppercase font-bold tracking-widest text-[#DC833D]">{{ $item->category ?? 'General' }}</span>
                        <span class="text-[10px] text-zinc-500">Order: {{ $item->order_index }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-zinc-500 italic">No gallery items found.</div>
        @endforelse
    </div>
@endsection