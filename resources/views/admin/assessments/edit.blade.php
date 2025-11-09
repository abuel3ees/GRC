@extends('layouts.admin')

@section('title', 'Edit Assessment')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    {{-- ===== Header ===== --}}
    <div class="flex items-center justify-between" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Edit Assessment</h1>
            <p class="text-muted-foreground text-sm">Modify details of this existing assessment</p>
        </div>

        <div class="flex gap-2">
            {{-- Back Button --}}
            <a href="{{ route('admin.assessments.show', $assessment) }}"
               class="px-4 py-2 border border-border text-sm rounded-md hover:bg-secondary transition">
               ← Back
            </a>

            {{-- Delete Shortcut --}}
            <form action="{{ route('admin.assessments.destroy', $assessment) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this assessment?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 border border-destructive text-destructive rounded-md hover:bg-destructive/10 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- ===== Edit Form ===== --}}
    <form action="{{ route('admin.assessments.update', $assessment) }}" method="POST"
          class="bg-card border border-border rounded-xl p-8 shadow-sm space-y-6" 
          data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-foreground mb-1">Title <span class="text-destructive">*</span></label>
            <input type="text" id="title" name="title" 
                   value="{{ old('title', $assessment->title) }}" 
                   required
                   class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('title')
                <p class="text-destructive text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition"
                      placeholder="Describe the scope, purpose, and details of this assessment...">{{ old('description', $assessment->description) }}</textarea>
            @error('description')
                <p class="text-destructive text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status" 
                    class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="draft" {{ old('status', $assessment->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="active" {{ old('status', $assessment->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="closed" {{ old('status', $assessment->status) == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            @error('status')
                <p class="text-destructive text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Owner --}}
        <div>
            <label for="owner" class="block text-sm font-medium text-foreground mb-1">Owner</label>
            <input type="text" id="owner" name="owner" 
                   value="{{ old('owner', $assessment->owner) }}" 
                   class="w-full px-4 py-2 border border-border bg-input text-foreground rounded-md focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition"
                   placeholder="e.g., John Doe / IT Department">
            @error('owner')
                <p class="text-destructive text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('admin.assessments.show', $assessment) }}"
               class="px-6 py-2 border border-border rounded-md text-sm hover:bg-secondary transition">
               Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-foreground text-background font-semibold rounded-md hover:opacity-90 transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
