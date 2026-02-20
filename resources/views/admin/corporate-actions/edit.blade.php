@extends('layouts.admin', ['title' => 'Edit Corporate Action'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.corporate-actions.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to
                List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.corporate-actions.update', $action) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Date</label>
                        <input type="date" name="date" value="{{ $action->date }}" required
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Category</label>
                        <input type="text" name="category" value="{{ $action->category }}" required
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Title</label>
                    <input type="text" name="title" value="{{ $action->title }}" required
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Short Summary</label>
                    <textarea name="summary" rows="3"
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">{{ $action->summary }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Full Content</label>
                    <textarea name="content" rows="8"
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">{{ $action->content }}</textarea>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    UPDATE ANNOUNCEMENT
                </button>
            </form>
        </div>
    </div>
@endsection