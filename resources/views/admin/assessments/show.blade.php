@extends('layouts.admin')

@section('title', 'Assessment Details')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">{{ $assessment->title }}</h1>
            <p class="text-sm text-muted-foreground">Detailed view of the assessment record</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.assessments.edit', $assessment) }}"
               class="px-4 py-2 bg-foreground text-background rounded-md hover:opacity-90 transition">
               Edit
            </a>
            <form action="{{ route('admin.assessments.destroy', $assessment) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this assessment?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 border border-destructive text-destructive rounded-md hover:bg-destructive/10 transition">
                    Delete
                </button>
            </form>
            <a href="{{ route('admin.assessments.index') }}" 
               class="px-4 py-2 border border-border text-sm rounded-md hover:bg-secondary transition">
               ← Back
            </a>
        </div>
    </div>

    {{-- ===== Assessment Summary ===== --}}
    <div class="bg-card border border-border rounded-xl p-8 space-y-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-muted-foreground mb-1">Status</p>
                <span class="px-3 py-1 text-xs rounded-md 
                    @if($assessment->status === 'active') bg-green-600/20 text-green-400 
                    @elseif($assessment->status === 'closed') bg-gray-600/20 text-gray-400
                    @else bg-yellow-600/20 text-yellow-400 @endif">
                    {{ ucfirst($assessment->status) }}
                </span>
            </div>

            <div>
                <p class="text-sm text-muted-foreground mb-1">Owner</p>
                <p class="text-foreground font-medium">{{ $assessment->owner ?? '—' }}</p>
            </div>

            <div>
                <p class="text-sm text-muted-foreground mb-1">Created On</p>
                <p class="text-foreground font-medium">{{ $assessment->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <div>
                <p class="text-sm text-muted-foreground mb-1">Last Updated</p>
                <p class="text-foreground font-medium">{{ $assessment->updated_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-border my-4"></div>

        {{-- Description --}}
        <div>
            <p class="text-sm text-muted-foreground mb-1">Description</p>
            <p class="text-foreground leading-relaxed whitespace-pre-line">
                {{ $assessment->description ?: 'No description provided.' }}
            </p>
        </div>
    </div>

    {{-- ===== Linked Data (if any) ===== --}}
    @if($assessment->results && $assessment->results->count() > 0)
        <div class="bg-card border border-border rounded-xl p-8 shadow-sm" data-aos="fade-up" data-aos-delay="150">
            <h2 class="text-lg font-bold text-foreground mb-4">Assessment Results</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-border rounded-md overflow-hidden">
                    <thead class="bg-muted text-foreground">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">Result ID</th>
                            <th class="px-4 py-3 text-left font-medium">Score</th>
                            <th class="px-4 py-3 text-left font-medium">Evaluator</th>
                            <th class="px-4 py-3 text-left font-medium">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border bg-card">
                        @foreach($assessment->results as $result)
                            <tr class="hover:bg-secondary/40 transition">
                                <td class="px-4 py-3">{{ $result->id }}</td>
                                <td class="px-4 py-3">{{ $result->score ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $result->evaluator ?? '—' }}</td>
                                <td class="px-4 py-3">{{ $result->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
