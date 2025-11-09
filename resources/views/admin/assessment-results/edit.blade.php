@extends('layouts.admin')

@section('title', 'Edit Assessment Result')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">
                Edit Assessment Result #{{ $assessmentResult->id }}
            </h1>
            <p class="text-sm text-muted-foreground">
                Update the details or score of this recorded result
            </p>
        </div>
        <a href="{{ route('admin.assessment-results.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Form ===== --}}
    <form action="{{ route('admin.assessment-results.update', $assessmentResult) }}" method="POST"
          class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-5"
          data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        {{-- Assessment ID (read-only) --}}
        <div>
            <label for="assessment_id" class="block text-sm font-medium text-foreground mb-1">
                Assessment ID
            </label>
            <input type="number" name="assessment_id" id="assessment_id"
                   value="{{ old('assessment_id', $assessmentResult->assessment_id) }}" readonly
                   class="w-full bg-muted/50 border border-border text-muted-foreground rounded-md px-3 py-2 text-sm cursor-not-allowed">
        </div>

        {{-- User ID (read-only) --}}
        <div>
            <label for="user_id" class="block text-sm font-medium text-foreground mb-1">
                User ID
            </label>
            <input type="number" name="user_id" id="user_id"
                   value="{{ old('user_id', $assessmentResult->user_id) }}" readonly
                   class="w-full bg-muted/50 border border-border text-muted-foreground rounded-md px-3 py-2 text-sm cursor-not-allowed">
        </div>

        {{-- Score --}}
        <div>
            <label for="score" class="block text-sm font-medium text-foreground mb-1">
                Score (%)
            </label>
            <input type="number" name="score" id="score" required min="0" max="100"
                   value="{{ old('score', $assessmentResult->score) }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('score')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">
                Status
            </label>
            <select name="status" id="status" required
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="pending" {{ old('status', $assessmentResult->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status', $assessmentResult->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="reviewed" {{ old('status', $assessmentResult->status) === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
            </select>
            @error('status')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remarks --}}
        <div>
            <label for="remarks" class="block text-sm font-medium text-foreground mb-1">
                Remarks (optional)
            </label>
            <textarea name="remarks" id="remarks" rows="4"
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition"
                      placeholder="Enter remarks or internal notes...">{{ old('remarks', $assessmentResult->remarks) }}</textarea>
            @error('remarks')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-foreground text-background font-semibold py-2.5 rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/50 transition">
                Update Result
            </button>
        </div>
    </form>
</div>
@endsection
