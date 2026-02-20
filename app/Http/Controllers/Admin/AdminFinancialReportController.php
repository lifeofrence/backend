<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFinancialReportController extends Controller
{
    public function index()
    {
        $reports = FinancialReport::orderBy('period', 'desc')->get();
        return view('admin.financial-reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.financial-reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:255',
            'type' => 'required|in:annual,quarterly',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('reports', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        FinancialReport::create($validated);

        return redirect()->route('admin.financial-reports.index')->with('success', 'Financial report added successfully.');
    }

    public function edit(FinancialReport $financial_report)
    {
        return view('admin.financial-reports.edit', ['report' => $financial_report]);
    }

    public function update(Request $request, FinancialReport $financial_report)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:255',
            'type' => 'required|in:annual,quarterly',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            if ($financial_report->file_path) {
                Storage::disk('public')->delete($financial_report->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('reports', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $financial_report->update($validated);

        return redirect()->route('admin.financial-reports.index')->with('success', 'Financial report updated successfully.');
    }

    public function destroy(FinancialReport $financial_report)
    {
        if ($financial_report->file_path) {
            Storage::disk('public')->delete($financial_report->file_path);
        }
        $financial_report->delete();

        return redirect()->route('admin.financial-reports.index')->with('success', 'Financial report deleted successfully.');
    }
}
