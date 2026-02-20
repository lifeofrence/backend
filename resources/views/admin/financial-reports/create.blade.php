@extends('layouts.admin', ['title' => 'Upload Financial Report'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.financial-reports.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to
                List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.financial-reports.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Reporting Period</label>
                        <input type="text" name="period" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                            placeholder="e.g. Q4 2024 or 2023">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Report Type</label>
                        <select name="type" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                            <option value="annual">Annual Report</option>
                            <option value="quarterly">Quarterly Result</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Report Title</label>
                    <input type="text" name="title" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="e.g. Unaudited Financial Results">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Subtitle (optional)</label>
                    <input type="text" name="subtitle" class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        placeholder="e.g. For the period ended...">
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-4 h-4 rounded border-zinc-800 text-[#DC833D] focus:ring-[#DC833D] bg-zinc-900">
                        <span class="text-sm font-medium text-zinc-300">Visible on website</span>
                    </label>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">PDF Document</label>
                    <div
                        class="border-2 border-dashed border-zinc-800 rounded-xl p-8 text-center hover:border-[#DC833D]/50 transition-colors cursor-pointer relative group">
                        <input type="file" name="file" required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-zinc-500 group-hover:text-zinc-300 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm font-medium">Upload PDF Report</p>
                            <p class="text-[10px] mt-1 uppercase tracking-widest">PDF up to 10MB</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    UPLOAD REPORT
                </button>
            </form>
        </div>
    </div>
@endsection