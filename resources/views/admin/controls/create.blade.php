@extends('layouts.admin')

@section('title', 'Create Control')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Create New Control</h1>
            <p class="text-sm text-muted-foreground">
                Define a new control measure linked to your organization’s risks and compliance frameworks.
            </p>
        </div>
        <a href="{{ route('admin.controls.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Form ===== --}}
    <form action="{{ route('admin.controls.store') }}" method="POST"
          class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-5"
          data-aos="fade-up" data-aos-delay="100">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-foreground mb-1">Control Title <span class="text-destructive">*</span></label>
            <input type="text" id="title" name="title" required
                   value="{{ old('title') }}"
                   placeholder="e.g., Access control enforcement"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('title')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
            <textarea id="description" name="description" rows="4"
                      placeholder="Describe the control procedure or policy..."
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('description') }}</textarea>
        </div>

        {{-- Type --}}
        <div>
            <label for="type" class="block text-sm font-medium text-foreground mb-1">Control Type <span class="text-destructive">*</span></label>
            <select id="type" name="type" required
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Select type</option>
                <option value="Preventive" {{ old('type') === 'Preventive' ? 'selected' : '' }}>Preventive</option>
                <option value="Detective" {{ old('type') === 'Detective' ? 'selected' : '' }}>Detective</option>
                <option value="Corrective" {{ old('type') === 'Corrective' ? 'selected' : '' }}>Corrective</option>
            </select>
        </div>

        {{-- Related Risk --}}
        <div>
            <label for="risk_id" class="block text-sm font-medium text-foreground mb-1">Related Risk</label>
            <select id="risk_id" name="risk_id"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Select related risk (optional)</option>
                @foreach($risks as $risk)
                    <option value="{{ $risk->id }}" {{ old('risk_id') == $risk->id ? 'selected' : '' }}>
                        {{ $risk->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="under_review" {{ old('status') === 'under_review' ? 'selected' : '' }}>Under Review</option>
            </select>
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-foreground text-background font-semibold py-2.5 rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/50 transition">
                Create Control
            </button>
        </div>
    </form>
</div>
@endsection
