<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssessmentResult;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class AssessmentResultController extends Controller
{
    /**
     * Display a listing of assessment results.
     */
    public function index(Request $request)
    {
        $results = QueryBuilder::for(AssessmentResult::query())
            ->allowedFilters([
                AllowedFilter::partial('assessment_id'),
                AllowedFilter::exact('user_id'),
                AllowedFilter::partial('score'),
                AllowedFilter::partial('status'),
            ])
            ->allowedSorts(['created_at', 'score', 'status'])
            ->defaultSort('-created_at')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.assessment-results.index', compact('results'));
    }

    /**
     * Show the form for creating a new assessment result.
     */
    public function create()
    {
        return view('admin.assessment-results.create');
    }

    /**
     * Store a newly created assessment result in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'assessment_id' => 'required|integer|exists:assessments,id',
            'user_id'       => 'required|integer|exists:users,id',
            'score'         => 'required|numeric|min:0|max:100',
            'status'        => 'required|string|in:pending,completed,reviewed',
            'remarks'       => 'nullable|string|max:500',
        ]);

        AssessmentResult::create($validated);

        return redirect()
            ->route('admin.assessment-results.index')
            ->with('success', 'Assessment result created successfully.');
    }

    /**
     * Display the specified assessment result.
     */
    public function show(AssessmentResult $assessmentResult)
    {
        return view('admin.assessment-results.show', compact('assessmentResult'));
    }

    /**
     * Show the form for editing the specified assessment result.
     */
    public function edit(AssessmentResult $assessmentResult)
    {
        return view('admin.assessment-results.edit', compact('assessmentResult'));
    }

    /**
     * Update the specified assessment result in storage.
     */
    public function update(Request $request, AssessmentResult $assessmentResult)
    {
        $validated = $request->validate([
            'score'   => 'required|numeric|min:0|max:100',
            'status'  => 'required|string|in:pending,completed,reviewed',
            'remarks' => 'nullable|string|max:500',
        ]);

        $assessmentResult->update($validated);

        return redirect()
            ->route('admin.assessment-results.index')
            ->with('success', 'Assessment result updated successfully.');
    }

    /**
     * Remove the specified assessment result from storage.
     */
    public function destroy(AssessmentResult $assessmentResult)
    {
        $assessmentResult->delete();

        return redirect()
            ->route('admin.assessment-results.index')
            ->with('success', 'Assessment result deleted successfully.');
    }
}
