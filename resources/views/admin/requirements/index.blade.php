@extends('layouts.admin')

@section('title', 'Compliance Requirements')

@section('content')
<div class="p-6 space-y-8">

    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Compliance Requirements</h1>
            <p class="text-muted-foreground text-sm">View and manage all framework requirements</p>
        </div>
        <a href="{{ route('admin.requirements.create') }}"
           class="bg-foreground text-background px-4 py-2 rounded-md hover:opacity-90 transition"
           data-aos="zoom-in">+ New Requirement</a>
    </div>

    {{-- ===== Filters ===== --}}
    <div class="flex flex-wrap gap-3 items-center" data-aos="fade-up" data-aos-delay="100">
        <input type="text" id="search-title" placeholder="Search title..."
               class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-ring/50">
        <select id="filter-status"
                class="border border-border bg-input text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="pending">Pending</option>
            <option value="retired">Retired</option>
        </select>
    </div>

    {{-- ===== Table ===== --}}
    <div class="bg-card border border-border rounded-xl shadow-sm overflow-hidden" data-aos="fade-up" data-aos-delay="150">
        <table class="min-w-full text-sm">
            <thead class="bg-muted text-foreground border-b border-border">
                <tr>
                    <th class="px-4 py-2 text-left">Framework</th>
                    <th class="px-4 py-2 text-left">Reference</th>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Category</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($requirements as $req)
                    <tr class="hover:bg-muted/30 transition">
                        <td class="px-4 py-2">{{ $req->framework->name ?? '—' }}</td>
                        <td class="px-4 py-2 text-muted-foreground">{{ $req->reference_code ?? '—' }}</td>
                        <td class="px-4 py-2 font-medium">{{ $req->title }}</td>
                        <td class="px-4 py-2">{{ $req->category ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $req->status === 'active' ? 'bg-emerald-500/20 text-emerald-400' : 
                                   ($req->status === 'pending' ? 'bg-amber-500/20 text-amber-400' : 'bg-gray-500/20 text-gray-400') }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-right space-x-2">
                            <a href="{{ route('admin.requirements.show', $req->id) }}" class="text-blue-400 hover:underline">View</a>
                            <a href="{{ route('admin.requirements.edit', $req->id) }}" class="text-accent-400 hover:underline">Edit</a>
                            <form action="{{ route('admin.requirements.destroy', $req->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-destructive hover:underline"
                                        onclick="return confirm('Delete this requirement?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-muted-foreground">No requirements found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ===== Pagination ===== --}}
    <div data-aos="fade-up" data-aos-delay="200">
        {{ $requirements->links() }}
    </div>

</div>
@endsection
