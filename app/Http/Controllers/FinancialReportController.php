<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FinancialReport::where('is_active', true)->orderBy('period', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:255',
            'type' => 'required|in:annual,quarterly',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('reports', 'public');
            $validated['file_path'] = $path;
        }

        $report = FinancialReport::create($validated);
        return response()->json($report, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialReport $financialReport)
    {
        return $financialReport;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialReport $financialReport)
    {
        $validated = $request->validate([
            'period' => 'string|max:255',
            'type' => 'in:annual,quarterly',
            'title' => 'string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('reports', 'public');
            $validated['file_path'] = $path;
        }

        $financialReport->update($validated);
        return response()->json($financialReport);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialReport $financialReport)
    {
        $financialReport->delete();
        return response()->json(null, 204);
    }
}
