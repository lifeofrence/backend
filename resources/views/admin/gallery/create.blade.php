@extends('layouts.admin', ['title' => 'New Gallery Image'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.gallery.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Image Title</label>
                    <input type="text" name="title" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="e.g. Hotel Lobby">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Category</label>
                        <input type="text" name="category" class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                            placeholder="e.g. Interior, Rooms">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Display Order</label>
                        <input type="number" name="order_index" value="0"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Description (optional)</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="Brief description..."></textarea>
                </div>

                <div class="space-y-4">
                    <label class="text-sm font-medium text-zinc-400">Gallery Image</label>
                    <div id="image-preview-container" class="hidden mb-4">
                        <img id="image-preview" src="#" alt="Preview"
                            class="w-full h-64 object-cover rounded-xl border border-white/10 shadow-2xl">
                    </div>

                    <div
                        class="border-2 border-dashed border-zinc-800 rounded-xl p-8 text-center hover:border-[#DC833D]/50 transition-colors cursor-pointer relative group">
                        <input type="file" name="image" id="gallery-image-input" required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-zinc-500 group-hover:text-zinc-300 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm font-medium">Click to upload image</p>
                            <p class="text-[10px] mt-1 uppercase tracking-widest">PNG, JPG up to 5MB</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    ADD TO GALLERY
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('gallery-image-input').addEventListener('change', function (e) {
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('image-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection