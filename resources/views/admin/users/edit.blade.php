@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="p-6 space-y-6">
    {{-- ===== Header ===== --}}
    <div class="flex justify-between items-center mb-4" data-aos="fade-up">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Edit User</h1>
            <p class="text-muted-foreground text-sm">Modify user details or update password</p>
        </div>
        <a href="{{ route('admin.users.show', $user) }}"
           class="text-sm text-accent hover:underline">← Back to Details</a>
    </div>

    {{-- ===== Form ===== --}}
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5" data-aos="fade-up" data-aos-delay="100">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-foreground mb-1">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="Enter full name">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-foreground mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="user@example.com">
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-foreground mb-1">Role</label>
            <select id="role" name="role"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-foreground mb-1">Status</label>
            <select id="status" name="status"
                    class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50">
                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Password (Optional) --}}
        <div class="pt-2">
            <label for="password" class="block text-sm font-medium text-foreground mb-1">New Password (optional)</label>
            <input type="password" id="password" name="password"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="Leave blank to keep current password">
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-foreground mb-1">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="w-full bg-input border border-border text-foreground rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-ring/50"
                   placeholder="Re-enter new password">
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-foreground text-background px-6 py-2.5 rounded-md font-medium hover:opacity-90 transition">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection
