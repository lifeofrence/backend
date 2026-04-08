<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeyMaterialController extends Controller
{
    private function withFileUrl(\App\Models\KeyMaterial $material): array
    {
        $data = $material->toArray();
        if ($material->file_path) {
            $filename = basename($material->file_path);
            $baseUrl = rtrim(config('app.url'), '/') . '/key-materials/' . $filename;
            $data['file_url'] = $baseUrl;
            $data['download_url'] = $baseUrl . '?download=1';
        } else {
            $data['file_url'] = null;
            $data['download_url'] = null;
        }
        return $data;
    }

    public function index()
    {
        return \App\Models\KeyMaterial::where('is_active', true)
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($m) { return $this->withFileUrl($m); });
    }

    public function show(\App\Models\KeyMaterial $keyMaterial)
    {
        return response()->json($this->withFileUrl($keyMaterial));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'file' => 'required|file|mimes:pdf|max:102400',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('', 'key_materials');
        }

        $material = \App\Models\KeyMaterial::create($validated);
        return response()->json($this->withFileUrl($material), 201);
    }

    public function update(Request $request, \App\Models\KeyMaterial $keyMaterial)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'category' => 'string|max:255',
            'date' => 'date',
            'file' => 'nullable|file|mimes:pdf|max:102400',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            if ($keyMaterial->file_path) {
                \Illuminate\Support\Facades\Storage::disk('key_materials')->delete($keyMaterial->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('', 'key_materials');
        }

        $keyMaterial->update($validated);
        return response()->json($this->withFileUrl($keyMaterial));
    }

    public function destroy(\App\Models\KeyMaterial $keyMaterial)
    {
        if ($keyMaterial->file_path) {
            \Illuminate\Support\Facades\Storage::disk('key_materials')->delete($keyMaterial->file_path);
        }
        $keyMaterial->delete();
        return response()->json(null, 204);
    }
}
