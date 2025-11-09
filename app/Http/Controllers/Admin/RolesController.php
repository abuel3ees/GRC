<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class RolesController extends Controller
{
    /**
     * Display a listing of roles with filters and pagination.
     */
    public function index(Request $request)
    {
        $roles = QueryBuilder::for(Roles::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('description'),
            ])
            ->allowedSorts(['name', 'created_at'])
            ->defaultSort('name')
            ->paginate(10)
            ->appends($request->query());

        // For AJAX filtering (live updates in table)
        if ($request->ajax()) {
            return view('admin.roles.partials.table', compact('roles'))->render();
        }

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'description' => 'nullable|string|max:500',
        ]);

        Roles::create($validated);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified role.
     */
    public function show(Roles $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Roles $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Roles $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:500',
        ]);

        $role->update($validated);

        return redirect()
            ->route('admin.roles.show', $role)
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Roles $role)
    {
        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
