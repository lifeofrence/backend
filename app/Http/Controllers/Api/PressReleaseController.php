<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function index()
    {
        return \App\Models\PressRelease::where('is_active', true)
            ->orderBy('date', 'desc')
            ->get();
    }

    public function show(\App\Models\PressRelease $pressRelease)
    {
        return response()->json($pressRelease);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:press_releases,slug|max:255',
            'date' => 'required|date',
            'content' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $pressRelease = \App\Models\PressRelease::create($validated);
        return response()->json($pressRelease, 201);
    }

    public function update(Request $request, \App\Models\PressRelease $pressRelease)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'slug' => 'string|max:255|unique:press_releases,slug,' . $pressRelease->id,
            'date' => 'date',
            'content' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $pressRelease->update($validated);
        return response()->json($pressRelease);
    }

    public function destroy(\App\Models\PressRelease $pressRelease)
    {
        $pressRelease->delete();
        return response()->json(null, 204);
    }
}
