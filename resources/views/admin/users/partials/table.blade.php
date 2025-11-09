{{-- resources/views/admin/users/partials/table.blade.php --}}
<table class="min-w-full text-sm border border-border/60 rounded-md overflow-hidden">
    <thead class="bg-muted/40 text-foreground">
        <tr>
            <th class="px-4 py-3 text-left font-semibold">Name</th>
            <th class="px-4 py-3 text-left font-semibold">Email</th>
            <th class="px-4 py-3 text-left font-semibold">Role</th>
            <th class="px-4 py-3 text-left font-semibold">Status</th>
            <th class="px-4 py-3 text-left font-semibold">Created</th>
            <th class="px-4 py-3 text-right font-semibold">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border/50 text-muted-foreground">
        @forelse ($users as $user)
            <tr class="hover:bg-muted/20 transition">
                <td class="px-4 py-3 text-foreground font-medium">{{ $user->name }}</td>
                <td class="px-4 py-3">{{ $user->email }}</td>
                <td class="px-4 py-3">{{ ucfirst($user->role->name ?? '—') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs rounded-full
                        @if($user->status === 'active') bg-green-500/20 text-green-400
                        @elseif($user->status === 'inactive') bg-gray-500/20 text-gray-400
                        @else bg-yellow-500/20 text-yellow-400 @endif">
                        {{ ucfirst($user->status ?? 'unknown') }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $user->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('admin.users.show', $user) }}" class="text-accent hover:underline text-sm">View</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-400 hover:underline text-sm">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-400 hover:underline text-sm"
                            onclick="return confirm('Delete this user?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-muted-foreground">
                    No users found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>
