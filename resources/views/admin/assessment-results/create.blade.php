@extends('layouts.admin')

@section('title', 'New Assessment Result')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Add Assessment Result</h1>
            <p class="text-sm text-muted-foreground">Record the result of a completed assessment</p>
        </div>
        <a href="{{ route('admin.assessment-results.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Form ===== --}}
    <form action="{{ route('admin.assessment-results.store') }}" method="POST" 
          class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-5"
          data-aos="fade-up" data-aos-delay="100">
        @csrf

        {{-- Assessment ID --}}
        <div>
            <label for="assessment_id" class="block text-sm font-medium text-foreground mb-1">
                Assessment ID
            </label>
            <input type="number" name="assessment_id" id="assessment_id" required
                   value="{{ old('assessment_id') }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('assessment_id')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- User ID --}}
        <div>
            <label for="user_id" class="block text-sm font-medium text-foreground mb-1">
                User ID
            </label>
            <input type="number" name="user_id" id="user_id" required
                   value="{{ old('user_id') }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('user_id')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Score --}}
        <div>
            <label for="score" class="block text-sm font-medium text-foreground mb-1">
                Score (%)
            </label>
            <input type="number" name="score" id="score" required min="0" max="100"
                   value="{{ old('score') }}"
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
                <option value="">Select Status</option>
                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="reviewed" {{ old('status') === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
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
                      placeholder="Enter any notes or remarks...">{{ old('remarks') }}</textarea>
            @error('remarks')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-foreground text-background font-semibold py-2.5 rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/50 transition">
                Save Result
            </button>
        </div>
    </form>
</div>
@endsection
