@extends('layouts.admin')

@section('title', 'Assessment Result Details')

@section('content')
<div class="p-6 space-y-6 max-w-4xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Assessment Result #{{ $assessmentResult->id }}</h1>
            <p class="text-sm text-muted-foreground">
                Detailed view of this assessment’s outcome and metadata
            </p>
        </div>
        <a href="{{ route('admin.assessment-results.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Details Card ===== --}}
    <div class="bg-card text-card-foreground border border-border/60 rounded-xl shadow-sm p-6 space-y-6"
         data-aos="fade-up" data-aos-delay="100">

        {{-- Top Meta Info --}}
        <div class="grid md:grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-muted-foreground mb-1">Assessment ID</p>
                <p class="font-medium text-foreground">{{ $assessmentResult->assessment_id }}</p>
            </div>

            <div>
                <p class="text-muted-foreground mb-1">User ID</p>
                <p class="font-medium text-foreground">{{ $assessmentResult->user_id }}</p>
            </div>

            <div>
                <p class="text-muted-foreground mb-1">Score</p>
                <p class="font-medium text-foreground">{{ $assessmentResult->score }}%</p>
            </div>

            <div>
                <p class="text-muted-foreground mb-1">Status</p>
                <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-medium
                    @if($assessmentResult->status === 'completed') bg-emerald-500/20 text-emerald-400
                    @elseif($assessmentResult->status === 'pending') bg-yellow-500/20 text-yellow-400
                    @elseif($assessmentResult->status === 'reviewed') bg-blue-500/20 text-blue-400
                    @endif">
                    {{ ucfirst($assessmentResult->status) }}
                </span>
            </div>

            <div>
                <p class="text-muted-foreground mb-1">Created At</p>
                <p class="font-medium text-foreground">{{ $assessmentResult->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <div>
                <p class="text-muted-foreground mb-1">Last Updated</p>
                <p class="font-medium text-foreground">{{ $assessmentResult->updated_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

        {{-- Remarks Section --}}
        <div>
            <p class="text-muted-foreground mb-1">Remarks</p>
            <div class="bg-input border border-border/60 rounded-md p-4 text-sm text-foreground whitespace-pre-line">
                {{ $assessmentResult->remarks ?: '— No remarks provided —' }}
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-border/50">
            <a href="{{ route('admin.assessment-results.edit', $assessmentResult) }}"
               class="px-4 py-2 bg-accent text-accent-foreground rounded-md hover:opacity-90 transition">
                Edit
            </a>
            <form method="POST" action="{{ route('admin.assessment-results.destroy', $assessmentResult) }}"
                  onsubmit="return confirm('Delete this assessment result?')" class="inline">
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
