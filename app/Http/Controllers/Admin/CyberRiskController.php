<?php

namespace App\Http\Controllers\Admin;

use App\Models\CyberRisk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class CyberRiskController extends Controller
{
    public function index(Request $request)
    {
        // ✅ Use CyberRisk model — not Risk
        $risks = QueryBuilder::for(CyberRisk::class)
            ->allowedFilters(['code', 'title', 'residual_level', 'score'])
            ->allowedSorts(['score', 'likelihood', 'impact'])
            ->paginate(10)
            ->appends($request->query());

        // Return partial table if AJAX
        if ($request->ajax()) {
            return view('admin.cyberrisks.partials.table', compact('risks'))->render();
        }

        // Return full page otherwise
        return view('admin.cyberrisks.index', compact('risks'));
    }

    public function create()
    {
        return view('admin.cyberrisks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'risk_statement' => 'required|string',
            'cause' => 'nullable|string',
            'consequence' => 'nullable|string',
            'existing_control' => 'nullable|string',
            'mitigation_plan' => 'nullable|string',
            'likelihood' => 'required|integer|min:1|max:5',
            'impact' => 'required|integer|min:1|max:5',
            'score' => 'required|integer|min:1|max:25',
            'residual_level' => 'required|string|in:High,Medium,Low',
        ]);

        CyberRisk::create($validated);

        return redirect()->route('admin.cyberrisks.index')
            ->with('success', 'Cyber risk created successfully.');
    }

    public function edit(CyberRisk $cyberrisk)
    {
        return view('admin.cyberrisks.edit', compact('cyberrisk'));
    }

    public function update(Request $request, CyberRisk $cyberrisk)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'risk_statement' => 'required|string',
            'likelihood' => 'required|integer|min:1|max:5',
            'impact' => 'required|integer|min:1|max:5',
            'score' => 'required|integer|min:1|max:25',
            'residual_level' => 'required|string|in:High,Medium,Low',
        ]);

        $cyberrisk->update($validated);

        return redirect()->route('admin.cyberrisks.index')
            ->with('success', 'Cyber risk updated successfully.');
    }

    public function destroy(CyberRisk $cyberrisk)
    {
        $cyberrisk->delete();
        return back()->with('success', 'Cyber risk deleted.');
    }
}
