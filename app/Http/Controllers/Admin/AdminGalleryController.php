<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::orderBy('order_index')->get();
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:20480',
            'category' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        // Ensure order_index is not null
        $validated['order_index'] = $validated['order_index'] ?? 0;

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item added successfully.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.gallery.edit', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:20480',
            'category' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        // Ensure order_index is not null
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully.');
    }
}
