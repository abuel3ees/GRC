@extends('layouts.admin')

@section('title', 'Edit Control')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Edit Control</h1>
            <p class="text-sm text-muted-foreground">Modify details of this control and its linkage to a risk.</p>
        </div>
        <a href="{{ route('admin.controls.index') }}"
           class="px-4 py-2 bg-muted text-foreground rounded-md hover:opacity-80 transition">
            ← Back
        </a>
    </div>

    {{-- ===== Form ===== --}}
    <form action="{{ route('admin.controls.update', $control) }}" method="POST"
          class="bg-card text-card-foreground rounded-xl border border-border/60 shadow-sm p-6 space-y-5"
          data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-foreground mb-1">Control Title</label>
            <input type="text" id="title" name="title" required
                   value="{{ old('title', $control->title) }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('description', $control->description) }}</textarea>
        </div>

        {{-- Type --}}
        <div>
            <label for="type" class="block text-sm font-medium text-foreground mb-1">Control Type</label>
            <select id="type" name="type" required
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                @foreach (['Preventive', 'Detective', 'Corrective'] as $type)
                    <option value="{{ $type }}" {{ old('type', $control->type) === $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Related Risk --}}
        <div>
            <label for="risk_id" class="block text-sm font-medium text-foreground mb-1">Related Risk</label>
            <select id="risk_id" name="risk_id"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="">None</option>
                @foreach($risks as $risk)
                    <option value="{{ $risk->id }}" {{ old('risk_id', $control->risk_id) == $risk->id ? 'selected' : '' }}>
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
                @foreach (['active', 'inactive', 'under_review'] as $status)
                    <option value="{{ $status }}" {{ old('status', $control->status) === $status ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-foreground text-background font-semibold py-2.5 rounded-md hover:opacity-90 focus:ring-2 focus:ring-ring/50 transition">
                Update Control
            </button>
        </div>
    </form>
</div>
@endsection
