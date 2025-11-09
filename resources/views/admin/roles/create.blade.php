@extends('layouts.admin')

@section('title', 'Create Role')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center mb-4" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Create New Role</h1>
            <p class="text-muted-foreground text-sm">Define a new role in the system</p>
        </div>
        <a href="{{ route('admin.roles.index') }}"
           class="text-sm text-accent hover:underline">← Back to Roles</a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.roles.store') }}" class="space-y-5" data-aos="fade-up" data-aos-delay="100">
        @csrf

        {{-- Role Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-foreground mb-1">Role Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="e.g., Administrator">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Description</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                      placeholder="Optional description of the role">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-foreground text-background px-6 py-2.5 rounded-md font-medium hover:opacity-90 transition">
                Create Role
            </button>
        </div>
    </form>
</div>
@endsection
