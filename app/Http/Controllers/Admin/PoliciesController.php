<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policies;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $policies = QueryBuilder::for(Policies::query())
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('status'),
                AllowedFilter::exact('category'),
            ])
            ->allowedSorts(['title', 'status', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate(10)
            ->appends($request->query());

        if ($request->ajax()) {
            return view('admin.policies.partials.table', compact('policies'))->render();
        }

        return view('admin.policies.index', compact('policies'));
    }

    /**
     * Show the form for creating a new policy.
     */
    public function create()
    {
        return view('admin.policies.create');
    }

    /**
     * Store a newly created policy in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'status' => 'required|in:draft,active,archived',
        ]);

        Policy::create($validated);

        return redirect()
            ->route('admin.policies.index')
            ->with('success', 'Policy created successfully.');
    }

    /**
     * Display the specified policy.
     */
    public function show(Policies $policy)
    {
        return view('admin.policies.show', compact('policy'));
    }

    /**
     * Show the form for editing the specified policy.
     */
    public function edit(Policies $policy)
    {
        return view('admin.policies.edit', compact('policy'));
    }

    /**
     * Update the specified policy in storage.
     */
    public function update(Request $request, Policy $policy)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'status' => 'required|in:draft,active,archived',
        ]);

        $policy->update($validated);

        return redirect()
            ->route('admin.policies.show', $policy)
            ->with('success', 'Policy updated successfully.');
    }

    /**
     * Remove the specified policy from storage.
     */
    public function destroy(Policies $policy)
    {
        $policy->delete();

        return redirect()
            ->route('admin.policies.index')
            ->with('success', 'Policy deleted successfully.');
    }
}
