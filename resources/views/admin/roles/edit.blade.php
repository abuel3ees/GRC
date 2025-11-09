@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center mb-4" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Edit Role</h1>
            <p class="text-muted-foreground text-sm">Modify details of this system role</p>
        </div>
        <a href="{{ route('admin.roles.show', $role) }}"
           class="text-sm text-accent hover:underline">← Back to Details</a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-5" data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        {{-- Role Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-foreground mb-1">Role Name</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $role->name) }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm
                          focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition"
                   placeholder="e.g., Administrator">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm
                             focus:ring-2 focus:ring-ring/50 focus:border-ring/50 transition"
                      placeholder="Optional description of the role">{{ old('description', $role->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-4 flex items-center gap-3">
            <button type="submit"
                    class="bg-foreground text-background px-6 py-2.5 rounded-md font-medium hover:opacity-90 transition">
                Save Changes
            </button>

            <a href="{{ route('admin.roles.index') }}"
               class="text-sm text-muted-foreground hover:text-foreground transition">
               Cancel
            </a>
        </div>
    </form>
</div>
@endsection
