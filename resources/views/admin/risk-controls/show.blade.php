@extends('layouts.admin')

@section('title', 'View Risk-Control Relationship')

@section('content')
<div class="p-6 space-y-8">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Risk-Control Relationship</h1>
            <p class="text-muted-foreground text-sm">Detailed information about this mapping</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.risk-controls.edit', $riskControl) }}"
               class="bg-foreground text-background px-4 py-2 rounded-md text-sm hover:opacity-90 transition">
                Edit
            </a>
            <form action="{{ route('admin.risk-controls.destroy', $riskControl) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this relationship?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-destructive text-destructive-foreground px-4 py-2 rounded-md text-sm hover:opacity-90 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- ===== Details Card ===== --}}
    <div class="bg-card text-card-foreground border border-border/60 rounded-lg p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold mb-3">Linked Items</h2>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Risk:</dt>
                        <dd class="text-foreground font-medium">{{ $riskControl->risk->title ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Control:</dt>
                        <dd class="text-foreground font-medium">{{ $riskControl->control->title ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Effectiveness:</dt>
                        <dd class="text-foreground">{{ $riskControl->effectiveness ?? 'Not specified' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Status:</dt>
                        <dd>
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($riskControl->status === 'active') bg-green-500/20 text-green-400
                                @elseif($riskControl->status === 'pending') bg-yellow-500/20 text-yellow-400
                                @else bg-gray-500/20 text-gray-400 @endif">
                                {{ ucfirst($riskControl->status) }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3">Timestamps</h2>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Created:</dt>
                        <dd class="text-foreground">{{ $riskControl->created_at->format('M d, Y') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Last Updated:</dt>
                        <dd class="text-foreground">{{ $riskControl->updated_at->diffForHumans() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- ===== Back Button ===== --}}
    <div class="pt-4">
        <a href="{{ route('admin.risk-controls.index') }}"
           class="inline-flex items-center text-accent hover:underline text-sm">
            ← Back to Risk-Control List
        </a>
    </div>
</div>
@endsection
