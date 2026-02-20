@extends('layouts.admin', ['title' => 'New Corporate Action'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.corporate-actions.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to
                List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.corporate-actions.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Date</label>
                        <input type="date" name="date" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Category</label>
                        <input type="text" name="category" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                            placeholder="e.g. Dividend, AGM">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Title</label>
                    <input type="text" name="title" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="Announcement Title">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Short Summary</label>
                    <textarea name="summary" rows="3" class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="Brief overview..."></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Full Content</label>
                    <textarea name="content" rows="8" class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="Detailed content..."></textarea>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    PUBLISH ANNOUNCEMENT
                </button>
            </form>
        </div>
    </div>
@endsection