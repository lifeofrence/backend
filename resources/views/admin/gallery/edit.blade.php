@extends('layouts.admin', ['title' => 'Edit Gallery Image'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.gallery.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.gallery.update', $item) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Image Title</label>
                    <input type="text" name="title" value="{{ $item->title }}" required
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Category</label>
                        <input type="text" name="category" value="{{ $item->category }}"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Display Order</label>
                        <input type="number" name="order_index" value="{{ $item->order_index }}"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Description (optional)</label>
                    <textarea name="description" rows="3"
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">{{ $item->description }}</textarea>
                </div>

                <div class="space-y-4">
                    <label class="text-sm font-medium text-zinc-400">Image Management</label>
                    <div class="mb-4">
                        <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-2">Current / New Preview</p>
                        <img id="image-preview" src="{{ Storage::url($item->image_path) }}"
                            class="w-full h-64 object-cover rounded-xl border border-white/10 shadow-2xl transition-all duration-500">
                    </div>

                    <label class="text-sm font-medium text-zinc-400">Replace Image (optional)</label>
                    <input type="file" name="image" id="gallery-image-input"
                        class="w-full text-zinc-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#DC833D]/10 file:text-[#DC833D] hover:file:bg-[#DC833D]/20 cursor-pointer">
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    UPDATE GALLERY ITEM
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('gallery-image-input').addEventListener('change', function (e) {
            const previewImage = document.getElementById('image-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.add('border-[#DC833D]'); // Highlight that it's changed
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection