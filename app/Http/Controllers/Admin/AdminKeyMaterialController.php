<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KeyMaterial;
use Illuminate\Support\Facades\Storage;

class AdminKeyMaterialController extends Controller
{
    public function index()
    {
        $key_materials = KeyMaterial::orderBy('date', 'desc')->get();
        return view('admin.key-materials.index', compact('key_materials'));
    }

    public function create()
    {
        return view('admin.key-materials.create');
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

        $validated['is_active'] = $request->has('is_active');

        KeyMaterial::create($validated);

        return redirect()->route('admin.key-materials.index')->with('success', 'Key Material added successfully.');
    }

    public function edit(KeyMaterial $key_material)
    {
        return view('admin.key-materials.edit', compact('key_material'));
    }

    public function update(Request $request, KeyMaterial $key_material)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf|max:102400',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            if ($key_material->file_path) {
                Storage::disk('key_materials')->delete($key_material->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('', 'key_materials');
        }

        $validated['is_active'] = $request->has('is_active');

        $key_material->update($validated);

        return redirect()->route('admin.key-materials.index')->with('success', 'Key Material updated successfully.');
    }

    public function destroy(KeyMaterial $key_material)
    {
        if ($key_material->file_path) {
            Storage::disk('key_materials')->delete($key_material->file_path);
        }
        $key_material->delete();

        return redirect()->route('admin.key-materials.index')->with('success', 'Key Material deleted successfully.');
    }
}
