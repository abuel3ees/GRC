<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplianceRequirement;
use App\Models\ComplianceFrameworks;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\View;
class ComplianceRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ✅ Filter + Sort + Paginate using Spatie QueryBuilder
        $requirements = QueryBuilder::for(ComplianceRequirement::class)
            ->allowedFilters(['title', 'category', 'status'])
            ->allowedSorts(['title', 'created_at', 'status'])
            ->with('framework:id,name')
            ->paginate(10)
            ->appends($request->query());

        // Return the index view with paginated data
        return view('admin.requirements.index', compact('requirements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $frameworks = ComplianceFrameworks::select('id')->get();

        return view('admin.requirements.create', compact('frameworks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'framework_id'   => ['required', 'exists:compliance_frameworks,id'],
            'reference_code' => ['nullable', 'string', 'max:100'],
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'category'       => ['nullable', Rule::in(['Legal', 'Technical', 'Organizational', 'Operational', 'Privacy', 'Security'])],
            'status'         => ['required', Rule::in(['active', 'retired', 'pending'])],
            'priority'       => ['nullable', 'integer', 'min:1'],
            'guidance'       => ['nullable', 'string'],
        ]);

        ComplianceRequirement::create($validated);

        return redirect()
            ->route('admin.requirements.index')
            ->with('success', 'Compliance requirement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplianceRequirement $complianceRequirement)
    {
        return view('admin.requirements.show', compact('complianceRequirement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplianceRequirement $complianceRequirement)
    {
        $frameworks = ComplianceFramework::select('id', 'name')->get();

        return view('admin.requirements.edit', compact('complianceRequirement', 'frameworks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplianceRequirement $complianceRequirement)
    {
        $validated = $request->validate([
            'framework_id'   => ['required', 'exists:compliance_frameworks,id'],
            'reference_code' => ['nullable', 'string', 'max:100'],
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'category'       => ['nullable', Rule::in(['Legal', 'Technical', 'Organizational', 'Operational', 'Privacy', 'Security'])],
            'status'         => ['required', Rule::in(['active', 'retired', 'pending'])],
            'priority'       => ['nullable', 'integer', 'min:1'],
            'guidance'       => ['nullable', 'string'],
        ]);

        $complianceRequirement->update($validated);

        return redirect()
            ->route('admin.requirements.index')
            ->with('success', 'Compliance requirement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplianceRequirement $complianceRequirement)
    {
        $complianceRequirement->delete();

        return redirect()
            ->route('admin.requirements.index')
            ->with('success', 'Compliance requirement deleted successfully.');
    }
}
