@extends('layouts.admin')

@section('title', 'View Control')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Control Details</h1>
            <p class="text-sm text-muted-foreground">Full details of this control and its associated risk.</p>
        </div>
        <a href="{{ route('admin.controls.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Card ===== --}}
    <div class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-4"
         data-aos="fade-up" data-aos-delay="100">
        <div>
            <h2 class="text-lg font-semibold text-foreground mb-1">{{ $control->title }}</h2>
            <p class="text-sm text-muted-foreground">{{ $control->description ?: 'No description provided.' }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-muted-foreground block mb-1">Control Type</span>
                <span class="font-medium text-foreground">{{ $control->type ?: '—' }}</span>
            </div>

            <div>
                <span class="text-muted-foreground block mb-1">Related Risk</span>
                @if($control->risk)
                    <a href="{{ route('admin.risks.show', $control->risk_id) }}" class="text-accent hover:underline">
                        {{ $control->risk->title }}
                    </a>
                @else
                    <span class="text-muted-foreground">—</span>
                @endif
            </div>

            <div>
                <span class="text-muted-foreground block mb-1">Status</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                    @if($control->status === 'active') bg-emerald-500/20 text-emerald-400
                    @elseif($control->status === 'inactive') bg-gray-500/20 text-gray-400
                    @elseif($control->status === 'under_review') bg-yellow-500/20 text-yellow-400
                    @else bg-muted/50 text-muted-foreground @endif">
                    {{ ucfirst(str_replace('_', ' ', $control->status)) }}
                </span>
            </div>

            <div>
                <span class="text-muted-foreground block mb-1">Last Updated</span>
                <span class="font-medium text-foreground">{{ $control->updated_at?->format('Y-m-d') }}</span>
            </div>
        </div>

        <div class="pt-4 border-t border-border/50 flex items-center justify-end gap-3">
            <a href="{{ route('admin.controls.edit', $control) }}"
               class="px-4 py-2 bg-accent text-accent-foreground rounded-md hover:opacity-90 transition">
                Edit
            </a>

            <form action="{{ route('admin.controls.destroy', $control) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this control?')">
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
