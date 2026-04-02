<?php

namespace App\Http\Controllers;

use App\Models\LeadershipMember;
use Illuminate\Http\Request;

class LeadershipMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function withImageUrl(LeadershipMember $member): array
    {
        $data = $member->toArray();
        if ($member->image_path) {
            $filename = basename($member->image_path);
            $data['image_url'] = rtrim(config('app.url'), '/') . '/leadership/' . $filename;
        } else {
            $data['image_url'] = null;
        }
        return $data;
    }

    public function index()
    {
        $members = LeadershipMember::orderBy('order_index')->get()
            ->map(function ($m) { return $this->withImageUrl($m); });

        return [
            'board_of_director' => $members->where('type', 'board')->values(),
            'management_team' => $members->where('type', 'management')->values(),
        ];
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
            'type' => 'required|in:board,management,board_of_director,management_team',
            'order_index' => 'integer'
        ]);

        // Standardize type before storing
        if ($validated['type'] === 'board_of_director') $validated['type'] = 'board';
        if ($validated['type'] === 'management_team') $validated['type'] = 'management';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('', 'leadership');
            $validated['image_path'] = $path;
        }

        $member = LeadershipMember::create($validated);
        return response()->json($this->withImageUrl($member), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeadershipMember $leadershipMember)
    {
        return response()->json($this->withImageUrl($leadershipMember));
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
            'type' => 'in:board,management,board_of_director,management_team',
            'order_index' => 'integer'
        ]);

        // Standardize type
        if (isset($validated['type'])) {
            if ($validated['type'] === 'board_of_director') $validated['type'] = 'board';
            if ($validated['type'] === 'management_team') $validated['type'] = 'management';
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('', 'leadership');
            $validated['image_path'] = $path;
        }

        $leadershipMember->update($validated);
        return response()->json($this->withImageUrl($leadershipMember));
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
