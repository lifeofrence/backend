<?php

namespace App\Http\Controllers;

use App\Models\CorporateAction;
use Illuminate\Http\Request;

class CorporateActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CorporateAction::orderBy('date', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'link_url' => 'nullable|string|max:255'
        ]);

        $action = CorporateAction::create($validated);
        return response()->json($action, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CorporateAction $corporateAction)
    {
        return $corporateAction;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CorporateAction $corporateAction)
    {
        $validated = $request->validate([
            'date' => 'date',
            'category' => 'string|max:255',
            'title' => 'string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'link_url' => 'nullable|string|max:255'
        ]);

        $corporateAction->update($validated);
        return response()->json($corporateAction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CorporateAction $corporateAction)
    {
        $corporateAction->delete();
        return response()->json(null, 204);
    }
}
