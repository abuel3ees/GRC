<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Risks;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class RisksController extends Controller
{
    /**
     * Display a listing of risks.
     */
    public function index(Request $request)
    {
        $risks = QueryBuilder::for(Risks::query())
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('category'),
                AllowedFilter::exact('severity'),
                AllowedFilter::exact('status'),
            ])
            ->allowedSorts(['title', 'severity', 'status', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate(10)
            ->appends($request->query());

        if ($request->ajax()) {
            return view('admin.risks.partials.table', compact('risks'))->render();
        }

        return view('admin.risks.index', compact('risks'));
    }

    /**
     * Show the form for creating a new risk.
     */
    public function create()
    {
        return view('admin.risks.create');
    }

    /**
     * Store a newly created risk in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'severity' => 'required|string|max:50',
            'status' => 'required|string|max:50',
        ]);

        Risk::create($validated);

        return redirect()->route('admin.risks.index')
            ->with('success', 'Risk created successfully.');
    }

    /**
     * Display the specified risk.
     */
    public function show(Risks $risks)
    {
        return view('admin.risks.show', compact('risk'));
    }

    /**
     * Show the form for editing the specified risk.
     */
    public function edit(Risk $risks)
    {
        return view('admin.risks.edit', compact('risk'));
    }

    /**
     * Update the specified risk in storage.
     */
    public function update(Request $request, Risks $risks)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'severity' => 'required|string|max:50',
            'status' => 'required|string|max:50',
        ]);

        $risk->update($validated);

        return redirect()->route('admin.risks.index')
            ->with('success', 'Risk updated successfully.');
    }

    /**
     * Remove the specified risk from storage.
     */
    public function destroy(Risks $risks)
    {
        $risk->delete();

        return redirect()->route('admin.risks.index')
            ->with('success', 'Risk deleted successfully.');
    }
}
