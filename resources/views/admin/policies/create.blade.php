@extends('layouts.admin')

@section('title', 'Create Policy')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Create New Policy</h1>
            <p class="text-muted-foreground text-sm">Add a new compliance or operational policy</p>
        </div>
        <a href="{{ route('admin.policies.index') }}"
           class="text-sm text-accent hover:underline">← Back to Policies</a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.policies.store') }}" class="space-y-5">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-foreground mb-1">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                   required
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Category --}}
        <div>
            <label for="category" class="block text-sm font-medium text-foreground mb-1">Category</label>
            <input type="text" id="category" name="category" value="{{ old('category') }}"
                   required
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
            @error('category') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-foreground text-background px-6 py-2.5 rounded-md font-medium hover:opacity-90 transition">
                Create Policy
            </button>
        </div>
    </form>
</div>
@endsection
