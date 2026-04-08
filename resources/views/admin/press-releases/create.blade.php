@extends('layouts.admin', ['title' => 'Add Press Release'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.press-releases.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.press-releases.store') }}" method="POST" class="space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-500/10 text-red-500 p-4 rounded-lg mb-6">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Title</label>
                    <input type="text" name="title" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="e.g. Q4 2025 Investor Presentation" value="{{ old('title') }}">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Date</label>
                        <input type="date" name="date" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none" value="{{ old('date') }}">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Slug (Optional)</label>
                        <input type="text" name="slug" class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                            placeholder="Auto-generated if left blank" value="{{ old('slug') }}">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Content (Optional)</label>
                    <textarea name="content" rows="6" class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="Enter the press release body here...">{{ old('content') }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-zinc-800 text-[#DC833D] focus:ring-[#DC833D] bg-zinc-900">
                        <span class="text-sm font-medium text-zinc-300">Visible on website</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    SAVE PRESS RELEASE
                </button>
            </form>
        </div>
    </div>
@endsection
