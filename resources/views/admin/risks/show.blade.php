@extends('layouts.admin')

@section('title', 'View Risk')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Risk Details</h1>
            <p class="text-sm text-muted-foreground">Comprehensive view of the selected risk.</p>
        </div>
        <a href="{{ route('admin.risks.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Details Card ===== --}}
    <div class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-4"
         data-aos="fade-up" data-aos-delay="100">
        <div>
            <h2 class="text-lg font-semibold text-foreground mb-1">{{ $risk->title }}</h2>
            <p class="text-sm text-muted-foreground">{{ $risk->description ?: 'No description provided.' }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-muted-foreground block mb-1">Category</span>
                <span class="font-medium text-foreground">{{ $risk->category ?: '—' }}</span>
            </div>

            <div>
                <span class="text-muted-foreground block mb-1">Severity</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                    @if($risk->severity === 'High') bg-red-500/20 text-red-400
                    @elseif($risk->severity === 'Medium') bg-yellow-500/20 text-yellow-400
                    @elseif($risk->severity === 'Low') bg-emerald-500/20 text-emerald-400
                    @else bg-muted/50 text-muted-foreground @endif">
                    {{ ucfirst($risk->severity) }}
                </span>
            </div>

            <div>
                <span class="text-muted-foreground block mb-1">Status</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                    @if($risk->status === 'open') bg-blue-500/20 text-blue-400
                    @elseif($risk->status === 'mitigated') bg-emerald-500/20 text-emerald-400
                    @elseif($risk->status === 'closed') bg-gray-500/20 text-gray-400
                    @else bg-muted/50 text-muted-foreground @endif">
                    {{ ucfirst($risk->status) }}
                </span>
            </div>

            <div>
                <span class="text-muted-foreground block mb-1">Created On</span>
                <span class="font-medium text-foreground">{{ $risk->created_at?->format('Y-m-d') }}</span>
            </div>
        </div>

        <div class="pt-4 border-t border-border/50 flex items-center justify-end gap-3">
            <a href="{{ route('admin.risks.edit', $risk) }}"
               class="px-4 py-2 bg-accent text-accent-foreground rounded-md hover:opacity-90 transition">
                Edit
            </a>

            <form action="{{ route('admin.risks.destroy', $risk) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this risk?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-destructive text-destructive-foreground rounded-md hover:opacity-90 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
