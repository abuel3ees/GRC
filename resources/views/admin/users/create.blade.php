@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center mb-4" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Create New User</h1>
            <p class="text-muted-foreground text-sm">Add a new user to the system</p>
        </div>
        <a href="{{ route('admin.users.index') }}"
           class="text-sm text-accent hover:underline">← Back to Users</a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5" data-aos="fade-up" data-aos-delay="100">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-foreground mb-1">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="Enter full name">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-foreground mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="user@example.com">
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-foreground mb-1">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="Enter a secure password">
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-foreground mb-1">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="Re-enter password">
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-foreground mb-1">Role</label>
            <select id="role" name="role"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
                <option value="">Select role...</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-foreground text-background px-6 py-2.5 rounded-md font-medium hover:opacity-90 transition">
                Create User
            </button>
        </div>
    </form>
</div>
@endsection
