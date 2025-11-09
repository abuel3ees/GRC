@extends('layouts.admin')

@section('title', 'Create Risk')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Create New Risk</h1>
            <p class="text-sm text-muted-foreground">Define a new organizational risk and categorize it by severity and type.</p>
        </div>
        <a href="{{ route('admin.risks.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Form ===== --}}
    <form action="{{ route('admin.risks.store') }}" method="POST"
          class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-5"
          data-aos="fade-up" data-aos-delay="100">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-foreground mb-1">
                Risk Title <span class="text-destructive">*</span>
            </label>
            <input type="text" id="title" name="title" required
                   value="{{ old('title') }}"
                   placeholder="e.g., Supply chain disruption"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('title')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">
                Description
            </label>
            <textarea id="description" name="description" rows="4"
                      placeholder="Describe the risk context and potential impact..."
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div>
            <label for="category" class="block text-sm font-medium text-foreground mb-1">
                Category
            </label>
            <select id="category" name="category"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Select category</option>
                <option value="Operational" {{ old('category') === 'Operational' ? 'selected' : '' }}>Operational</option>
                <option value="Financial" {{ old('category') === 'Financial' ? 'selected' : '' }}>Financial</option>
                <option value="Strategic" {{ old('category') === 'Strategic' ? 'selected' : '' }}>Strategic</option>
                <option value="Compliance" {{ old('category') === 'Compliance' ? 'selected' : '' }}>Compliance</option>
            </select>
            @error('category')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Severity --}}
        <div>
            <label for="severity" class="block text-sm font-medium text-foreground mb-1">
                Severity <span class="text-destructive">*</span>
            </label>
            <select id="severity" name="severity" required
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Select severity</option>
                <option value="High" {{ old('severity') === 'High' ? 'selected' : '' }}>High</option>
                <option value="Medium" {{ old('severity') === 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Low" {{ old('severity') === 'Low' ? 'selected' : '' }}>Low</option>
            </select>
            @error('severity')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">
                Status <span class="text-destructive">*</span>
            </label>
            <select id="status" name="status" required
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Select status</option>
                <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>Open</option>
                <option value="mitigated" {{ old('status') === 'mitigated' ? 'selected' : '' }}>Mitigated</option>
                <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            @error('status')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-foreground text-background font-semibold py-2.5 rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/50 transition">
                Create Risk
            </button>
        </div>
    </form>
</div>
@endsection
