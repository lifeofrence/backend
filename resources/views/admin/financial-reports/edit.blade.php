@extends('layouts.admin', ['title' => 'Edit Financial Report'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.financial-reports.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to
                List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.financial-reports.update', $report) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Reporting Period</label>
                        <input type="text" name="period" value="{{ $report->period }}" required
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Report Type</label>
                        <select name="type" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                            <option value="annual" {{ $report->type == 'annual' ? 'selected' : '' }}>Annual Report</option>
                            <option value="quarterly" {{ $report->type == 'quarterly' ? 'selected' : '' }}>Quarterly Result
                            </option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Report Title</label>
                    <input type="text" name="title" value="{{ $report->title }}" required
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Subtitle (optional)</label>
                    <input type="text" name="subtitle" value="{{ $report->subtitle }}"
                        class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $report->is_active ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-zinc-800 text-[#DC833D] focus:ring-[#DC833D] bg-zinc-900">
                        <span class="text-sm font-medium text-zinc-300">Visible on website</span>
                    </label>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Current File</label>
                    <div class="flex items-center space-x-3 mb-2 p-3 rounded-lg bg-white/5 border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <a href="{{ Storage::url($report->file_path) }}" target="_blank"
                            class="text-xs text-[#DC833D] hover:underline">View Current PDF</a>
                    </div>
                    <label class="text-sm font-medium text-zinc-400">Replace PDF Document (optional)</label>
                    <input type="file" name="file"
                        class="w-full text-zinc-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#DC833D]/10 file:text-[#DC833D] hover:file:bg-[#DC833D]/20 cursor-pointer">
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    UPDATE REPORT
                </button>
            </form>
        </div>
    </div>
@endsection