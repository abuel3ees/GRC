<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\View;
use App\Models\Assessments;
class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assessments = QueryBuilder::for(Assessments::query())
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('status'),
                AllowedFilter::partial('owner'),
            ])
            ->allowedSorts(['title', 'status', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate(10)
            ->appends($request->query());

        // AJAX request for dynamic updates (table only)
        if ($request->ajax()) {
            return view('admin.assessments.partials.table', compact('assessments'))->render();
        }

        return view('admin.assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.assessments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', Rule::in(['draft', 'active', 'closed'])],
            'owner'       => ['nullable', 'string', 'max:255'],
        ]);

        Assessments::create($validated);

        return redirect()
            ->route('admin.assessments.index')
            ->with('success', 'Assessment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessments $assessment)
    {
        return view('admin.assessments.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessments $assessment)
    {
        return view('admin.assessments.edit', compact('assessment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assessments $assessment)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', Rule::in(['draft', 'active', 'closed'])],
            'owner'       => ['nullable', 'string', 'max:255'],
        ]);

        $assessment->update($validated);

        return redirect()
            ->route('admin.assessments.index')
            ->with('success', 'Assessment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessments $assessment)
    {
        $assessment->delete();

        return redirect()
            ->route('admin.assessments.index')
            ->with('success', 'Assessment deleted successfully.');
    }
}
