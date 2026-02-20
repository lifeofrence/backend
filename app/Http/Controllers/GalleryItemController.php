<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GalleryItem::orderBy('order_index')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:5120', // 5MB max
            'category' => 'nullable|string|max:255',
            'order_index' => 'integer'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = $path;
        }

        $item = GalleryItem::create($validated);
        return response()->json($item, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryItem $galleryItem)
    {
        return $galleryItem;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryItem $galleryItem)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'category' => 'nullable|string|max:255',
            'order_index' => 'integer'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = $path;
        }

        $galleryItem->update($validated);
        return response()->json($galleryItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryItem $galleryItem)
    {
        $galleryItem->delete();
        return response()->json(null, 204);
    }
}
