<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CorporateAction;
use Illuminate\Http\Request;

class AdminCorporateActionController extends Controller
{
    public function index()
    {
        $actions = CorporateAction::orderBy('date', 'desc')->get();
        return view('admin.corporate-actions.index', compact('actions'));
    }

    public function create()
    {
        return view('admin.corporate-actions.create');
    }

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

        CorporateAction::create($validated);

        return redirect()->route('admin.corporate-actions.index')->with('success', 'Corporate action added successfully.');
    }

    public function edit(CorporateAction $corporate_action)
    {
        return view('admin.corporate-actions.edit', ['action' => $corporate_action]);
    }

    public function update(Request $request, CorporateAction $corporate_action)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'link_url' => 'nullable|string|max:255'
        ]);

        $corporate_action->update($validated);

        return redirect()->route('admin.corporate-actions.index')->with('success', 'Corporate action updated successfully.');
    }

    public function destroy(CorporateAction $corporate_action)
    {
        $corporate_action->delete();
        return redirect()->route('admin.corporate-actions.index')->with('success', 'Corporate action deleted successfully.');
    }
}
