<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PressRelease;
use Illuminate\Support\Str;

class AdminPressReleaseController extends Controller
{
    public function index()
    {
        $press_releases = PressRelease::orderBy('date', 'desc')->get();
        return view('admin.press-releases.index', compact('press_releases'));
    }

    public function create()
    {
        return view('admin.press-releases.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:press_releases,slug',
            'date' => 'required|date',
            'content' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        $validated['is_active'] = $request->has('is_active');

        PressRelease::create($validated);

        return redirect()->route('admin.press-releases.index')->with('success', 'Press release added successfully.');
    }

    public function edit(PressRelease $press_release)
    {
        return view('admin.press-releases.edit', compact('press_release'));
    }

    public function update(Request $request, PressRelease $press_release)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:press_releases,slug,' . $press_release->id,
            'date' => 'required|date',
            'content' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        $validated['is_active'] = $request->has('is_active');

        $press_release->update($validated);

        return redirect()->route('admin.press-releases.index')->with('success', 'Press release updated successfully.');
    }

    public function destroy(PressRelease $press_release)
    {
        $press_release->delete();

        return redirect()->route('admin.press-releases.index')->with('success', 'Press release deleted successfully.');
    }
}
