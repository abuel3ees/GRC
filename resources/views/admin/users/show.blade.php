@extends('layouts.admin')

@section('title', 'View User')

@section('content')
<div class="p-6 space-y-8">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">User Details</h1>
            <p class="text-muted-foreground text-sm">View full details for this user</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.edit', $user) }}"
               class="bg-foreground text-background px-4 py-2 rounded-md text-sm hover:opacity-90 transition">
                Edit
            </a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-destructive text-destructive-foreground px-4 py-2 rounded-md text-sm hover:opacity-90 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- ===== User Card ===== --}}
    <div class="bg-card text-card-foreground border border-border/60 rounded-lg p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold mb-3">Personal Information</h2>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Name:</dt>
                        <dd class="text-foreground font-medium">{{ $user->name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Email:</dt>
                        <dd class="text-foreground">{{ $user->email }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Role:</dt>
                        <dd class="text-foreground">{{ ucfirst($user->role ?? '—') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Status:</dt>
                        <dd>
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($user->status === 'active') bg-green-500/20 text-green-400
                                @else bg-gray-500/20 text-gray-400 @endif">
                                {{ ucfirst($user->status ?? 'inactive') }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3">Timestamps</h2>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Created:</dt>
                        <dd class="text-foreground">{{ $user->created_at->format('M d, Y') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Last Updated:</dt>
                        <dd class="text-foreground">{{ $user->updated_at->diffForHumans() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- ===== Back Button ===== --}}
    <div class="pt-4">
        <a href="{{ route('admin.users.index') }}"
           class="inline-flex items-center text-accent hover:underline text-sm">
            ← Back to User List
        </a>
    </div>
</div>
@endsection
