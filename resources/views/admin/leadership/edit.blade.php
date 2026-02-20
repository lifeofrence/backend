@extends('layouts.admin', ['title' => 'Edit Member Profile'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.leadership.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to
                List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.leadership.update', $member) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">FullName</label>
                        <input type="text" name="name" value="{{ $member->name }}" required
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Role / Title</label>
                        <input type="text" name="title" value="{{ $member->title }}" required
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Team Type</label>
                        <select name="type" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                            <option value="board" {{ $member->type == 'board' ? 'selected' : '' }}>Board of Directors</option>
                            <option value="management" {{ $member->type == 'management' ? 'selected' : '' }}>Management Team
                            </option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Display Order</label>
                        <input type="number" name="order_index" value="{{ $member->order_index }}"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Biography</label>
                    <textarea name="bio" rows="6"
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">{{ $member->bio }}</textarea>
                </div>

                <div class="space-y-4">
                    <label class="text-sm font-medium text-zinc-400">Profile Image</label>
                    <div class="flex items-center space-x-6 mb-4">
                        <div class="relative">
                            <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-2 text-center">Preview</p>
                            <img id="image-preview"
                                src="{{ Str::startsWith($member->image_path, '/') ? $member->image_path : Storage::url($member->image_path) }}"
                                class="w-32 h-32 rounded-xl object-cover border border-white/10 shadow-2xl transition-all duration-500">
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-zinc-400 leading-relaxed italic mb-4">You are viewing the current profile
                                picture. If you select a new one, this preview will update automatically.</p>
                            <input type="file" name="image" id="leadership-image-input"
                                class="w-full text-zinc-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#DC833D]/10 file:text-[#DC833D] hover:file:bg-[#DC833D]/20 cursor-pointer">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    UPDATE MEMBER PROFILE
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('leadership-image-input').addEventListener('change', function (e) {
            const previewImage = document.getElementById('image-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.add('border-[#DC833D]', 'ring-4', 'ring-[#DC833D]/20');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection