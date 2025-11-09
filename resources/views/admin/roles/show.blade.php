@extends('layouts.admin')

@section('title', 'View Role')

@section('content')
<div class="p-6 space-y-8">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Role Details</h1>
            <p class="text-muted-foreground text-sm">View details about this role</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.roles.edit', $role) }}"
               class="bg-foreground text-background px-4 py-2 rounded-md text-sm hover:opacity-90 transition">
                Edit
            </a>
            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this role?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-destructive text-destructive-foreground px-4 py-2 rounded-md text-sm hover:opacity-90 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- ===== Role Card ===== --}}
    <div class="bg-card text-card-foreground border border-border/60 rounded-lg p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
        <div class="space-y-4">
            <div>
                <h2 class="text-lg font-semibold text-foreground mb-2">Role Name</h2>
                <p class="text-muted-foreground">{{ $role->name }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-foreground mb-2">Description</h2>
                <p class="text-muted-foreground">{{ $role->description ?? '—' }}</p>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-4">
                <div>
                    <p class="text-sm text-muted-foreground">Created</p>
                    <p class="text-foreground font-medium">{{ $role->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-muted-foreground">Last Updated</p>
                    <p class="text-foreground font-medium">{{ $role->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Back Button ===== --}}
    <div class="pt-4">
        <a href="{{ route('admin.roles.index') }}"
           class="inline-flex items-center text-accent hover:underline text-sm">
            ← Back to Roles
        </a>
    </div>
</div>
@endsection
