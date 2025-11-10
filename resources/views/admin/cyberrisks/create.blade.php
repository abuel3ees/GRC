@extends('layouts.admin')

@section('title', 'Add Cyber Risk')

@section('content')
<div class="p-6 space-y-6 max-w-5xl mx-auto">

    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Add New Cyber Risk</h1>
            <p class="text-sm text-muted-foreground">
                Define and document a cybersecurity-related risk, including likelihood, impact, and mitigation plan.
            </p>
        </div>
        <a href="{{ route('admin.cyberrisks.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:bg-muted/80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.cyberrisks.store') }}"
          class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-6"
          data-aos="fade-up" data-aos-delay="50">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-12 gap-5">

            {{-- Code --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-foreground mb-1">Code</label>
                <input type="text" name="code" value="{{ old('code') }}" required
                       placeholder="R1"
                       class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @error('code')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Title --}}
            <div class="md:col-span-10">
                <label class="block text-sm font-medium text-foreground mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       placeholder="e.g., Ransomware attack on internal servers"
                       class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @error('title')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Risk Statement --}}
        <div>
            <label class="block text-sm font-medium text-foreground mb-1">Risk Statement</label>
            <textarea name="risk_statement" rows="2" required
                      placeholder="Describe the risk in clear terms..."
                      class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('risk_statement') }}</textarea>
            @error('risk_statement')
                <p class="text-destructive text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Cause & Consequence --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Cause</label>
                <textarea name="cause" rows="2"
                          placeholder="Root causes or vulnerabilities leading to this risk..."
                          class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('cause') }}</textarea>
                @error('cause')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Consequence</label>
                <textarea name="consequence" rows="2"
                          placeholder="Potential business or operational impact..."
                          class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('consequence') }}</textarea>
                @error('consequence')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Existing Control & Mitigation Plan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Existing Control</label>
                <textarea name="existing_control" rows="2"
                          placeholder="List existing preventive or detective controls..."
                          class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('existing_control') }}</textarea>
                @error('existing_control')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Mitigation Plan</label>
                <textarea name="mitigation_plan" rows="2"
                          placeholder="Outline actions or next steps to reduce this risk..."
                          class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('mitigation_plan') }}</textarea>
                @error('mitigation_plan')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Likelihood, Impact, Score, Residual Level --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Likelihood (1–5)</label>
                <input type="number" name="likelihood" min="1" max="5" required
                       value="{{ old('likelihood') }}"
                       class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @error('likelihood')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Impact (1–5)</label>
                <input type="number" name="impact" min="1" max="5" required
                       value="{{ old('impact') }}"
                       class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @error('impact')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Score</label>
                <input type="number" name="score" required value="{{ old('score') }}"
                       placeholder="Auto or manual risk score"
                       class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @error('score')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-foreground mb-1">Residual Level</label>
                <select name="residual_level"
                        class="w-full bg-input border border-border rounded-md px-3 py-2 text-sm text-foreground focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                    <option value="High" {{ old('residual_level') === 'High' ? 'selected' : '' }}>High</option>
                    <option value="Medium" {{ old('residual_level') === 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ old('residual_level') === 'Low' ? 'selected' : '' }}>Low</option>
                </select>
                @error('residual_level')
                    <p class="text-destructive text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-foreground text-background font-semibold py-2.5 rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/50 transition">
                Save Risk
            </button>
        </div>
    </form>
</div>
@endsection
