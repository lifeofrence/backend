<?php

namespace App\Http\Controllers;

use App\Models\LeadershipMember;
use Illuminate\Http\Request;

class LeadershipMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LeadershipMember::orderBy('order_index')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'type' => 'required|in:board,management',
            'order_index' => 'integer'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('leadership', 'public');
            $validated['image_path'] = $path;
        }

        $member = LeadershipMember::create($validated);
        return response()->json($member, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeadershipMember $leadershipMember)
    {
        return $leadershipMember;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeadershipMember $leadershipMember)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'title' => 'string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'type' => 'in:board,management',
            'order_index' => 'integer'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('leadership', 'public');
            $validated['image_path'] = $path;
        }

        $leadershipMember->update($validated);
        return response()->json($leadershipMember);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeadershipMember $leadershipMember)
    {
        $leadershipMember->delete();
        return response()->json(null, 204);
    }
}
