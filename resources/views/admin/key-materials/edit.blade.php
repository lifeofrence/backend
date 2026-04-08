@extends('layouts.admin', ['title' => 'Edit Key Material'])

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('admin.key-materials.index') }}" class="text-[#DC833D] hover:underline text-sm">← Back to
                List</a>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.key-materials.update', $key_material) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-500/10 text-red-500 p-4 rounded-lg mb-6">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Date</label>
                        <input type="date" name="date" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                            value="{{ old('date', \Carbon\Carbon::parse($key_material->date)->format('Y-m-d')) }}">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-400">Category</label>
                        <select name="category" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none">
                            <option value="quarterly_results" {{ old('category', $key_material->category) == 'quarterly_results' ? 'selected' : '' }}>Quarterly Results</option>
                            <option value="annual_materials" {{ old('category', $key_material->category) == 'annual_materials' ? 'selected' : '' }}>Annual Materials</option>
                            <option value="corporate_responsibility_disclosures" {{ old('category', $key_material->category) == 'corporate_responsibility_disclosures' ? 'selected' : '' }}>Corporate Responsibility Disclosures</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">Report Title</label>
                    <input type="text" name="title" required class="w-full rounded-lg px-4 py-2.5 focus:outline-none"
                        value="{{ old('title', $key_material->title) }}">
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $key_material->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-zinc-800 text-[#DC833D] focus:ring-[#DC833D] bg-zinc-900">
                        <span class="text-sm font-medium text-zinc-300">Visible on website</span>
                    </label>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-400">PDF Document (Leave blank to keep existing)</label>
                    @if($key_material->file_path)
                        <div class="mb-4">
                            <a href="{{ url('key-materials/' . basename($key_material->file_path)) }}" target="_blank"
                                class="text-sm text-[#DC833D] hover:underline">View Current PDF: {{ basename($key_material->file_path) }}</a>
                        </div>
                    @endif
                    <div id="pdf-upload-container"
                        class="border-2 border-dashed border-zinc-800 rounded-xl p-8 text-center hover:border-[#DC833D]/50 transition-colors cursor-pointer relative group">
                        <input type="file" name="file" id="pdf-input" accept=".pdf"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div id="upload-placeholder" class="text-zinc-500 group-hover:text-zinc-300 transition-colors pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm font-medium">Upload New PDF Report</p>
                            <p class="text-[10px] mt-1 uppercase tracking-widest">PDF up to 100MB</p>
                        </div>
                        <div id="upload-success" class="hidden text-emerald-500 transition-colors pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p id="filename-display" class="text-sm font-bold truncate px-4"></p>
                            <p class="text-[10px] mt-1 uppercase tracking-widest text-[#DC833D]">New File selected</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-widest mt-4">
                    UPDATE MATERIAL
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('pdf-input').addEventListener('change', function (e) {
            const placeholder = document.getElementById('upload-placeholder');
            const success = document.getElementById('upload-success');
            const filenameDisplay = document.getElementById('filename-display');
            const container = document.getElementById('pdf-upload-container');
            const file = e.target.files[0];

            if (file) {
                filenameDisplay.textContent = file.name;
                placeholder.classList.add('hidden');
                success.classList.remove('hidden');
                container.classList.remove('border-zinc-800');
                container.classList.add('border-emerald-500/50', 'bg-emerald-500/5');
            } else {
                placeholder.classList.remove('hidden');
                success.classList.add('hidden');
                container.classList.add('border-zinc-800');
                container.classList.remove('border-emerald-500/50', 'bg-emerald-500/5');
            }
        });
    </script>
@endsection
