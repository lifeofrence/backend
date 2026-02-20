<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLeadershipController extends Controller
{
    public function index()
    {
        $members = LeadershipMember::orderBy('order_index')->get();
        return view('admin.leadership.index', compact('members'));
    }

    public function create()
    {
        return view('admin.leadership.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'type' => 'required|in:board,management',
            'order_index' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('leadership', 'public');
        }

        // Ensure order_index is not null
        $validated['order_index'] = $validated['order_index'] ?? 0;

        LeadershipMember::create($validated);

        return redirect()->route('admin.leadership.index')->with('success', 'Member added successfully.');
    }

    public function edit(LeadershipMember $leadership)
    {
        return view('admin.leadership.edit', ['member' => $leadership]);
    }

    public function update(Request $request, LeadershipMember $leadership)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'type' => 'required|in:board,management',
            'order_index' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            if ($leadership->image_path) {
                Storage::disk('public')->delete($leadership->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('leadership', 'public');
        }

        // Ensure order_index is not null
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $leadership->update($validated);

        return redirect()->route('admin.leadership.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(LeadershipMember $leadership)
    {
        if ($leadership->image_path) {
            Storage::disk('public')->delete($leadership->image_path);
        }
        $leadership->delete();

        return redirect()->route('admin.leadership.index')->with('success', 'Member deleted successfully.');
    }
}
