@extends('layouts.admin')

@section('title', 'Edit Risk')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Edit Risk</h1>
            <p class="text-sm text-muted-foreground">Update this risk’s details or classification.</p>
        </div>
        <a href="{{ route('admin.risks.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Form ===== --}}
    <form action="{{ route('admin.risks.update', $risk) }}" method="POST"
          class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-5"
          data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-foreground mb-1">Risk Title</label>
            <input type="text" id="title" name="title" required
                   value="{{ old('title', $risk->title) }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('title')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition"
                      placeholder="Describe the risk context...">{{ old('description', $risk->description) }}</textarea>
            @error('description')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div>
            <label for="category" class="block text-sm font-medium text-foreground mb-1">Category</label>
            <select id="category" name="category"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">Select category</option>
                @foreach (['Operational', 'Financial', 'Strategic', 'Compliance'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $risk->category) === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Severity --}}
        <div>
            <label for="severity" class="block text-sm font-medium text-foreground mb-1">Severity</label>
            <select id="severity" name="severity" required
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @foreach (['High', 'Medium', 'Low'] as $level)
                    <option value="{{ $level }}" {{ old('severity', $risk->severity) === $level ? 'selected' : '' }}>
                        {{ $level }}
                    </option>
                @endforeach
            </select>
            @error('severity')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status" required
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @foreach (['open', 'mitigated', 'closed'] as $state)
                    <option value="{{ $state }}" {{ old('status', $risk->status) === $state ? 'selected' : '' }}>
                        {{ ucfirst($state) }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-foreground text-background font-semibold py-2.5 rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/50 transition">
                Update Risk
            </button>
        </div>
    </form>
</div>
@endsection
